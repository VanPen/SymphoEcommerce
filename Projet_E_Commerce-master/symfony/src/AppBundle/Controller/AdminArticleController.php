<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CatToProduct;
use AppBundle\Entity\imageProduct;
use AppBundle\Entity\stock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\products;
use Symfony\Component\HttpFoundation\Request;
use Test\Fixture\Entity\Shop\Product;


class AdminArticleController extends Controller
{
    /**
     * @Route("admin/new_article")
     */
    public function NewArticleAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:category')
        ;
        $category = $repository->findAll();
        return $this->render('AppBundle:AdminArticle:new_article.html.twig', array(
            'category' => $category
        ));
    }

    /**
     * @Route("admin/new_article/go")
     */
    public function NewArticleGOAction(Request $request)
    {

        $name = $_POST['name'];
        $describ = $_POST['describ'];
        $feature = $_POST['feature'];
        $color = $_POST['color'];
        $weigth = $_POST['weigth'];
        $price_HT = $_POST['price_HT'];
        $price_TTC = $_POST['price_HT']+($_POST['price_HT']*20/100);
        $statut = $_POST['statut'];
        $idCat = $_POST['category'];
        $stocks = $_POST['stock'];




        $em = $this->getDoctrine()->getManager();
        $product = new products();
        $product->setName($name);
        $product->setRef($this->generateRandomString());
        $product->setDescrib($describ);
        $product->setFeature($feature);
        $product->setColor($color);
        $product->setWeigth($weigth);
        $product->setDateCreate(new \DateTime('now'));
        $product->setDateModif(new \DateTime('now'));
        $product->setPriceHT($price_HT);
        $product->setPriceTTC($price_TTC);
        $product->setStatutProduct($statut);
        $em->persist($product);
        $em->flush();

        $idProduct = $product->getIdProduct();
        $RAW_QUERY = 'INSERT INTO `categories_products`(`category_id`, `product_id`) VALUES ("'.$idCat.'", "'.$idProduct.'")';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $stock = new stock();
        $stock->setIdProduct($idProduct);
        $stock->setStock($stocks);
        $stock->setDateModif(new \DateTime('now'));
        $em->persist($stock);
        $em->flush();
         $this->imageCheck($idProduct);

        return $this->redirect('/admin/categorie/'.$idCat);
    }

    /**
     * @Route("admin/update_article/{id}")
     */
    public function UpdateArticleAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:category')
        ;
        $category = $repository->findAll();

        $db = $this->getDoctrine()->getManager();
        $product = $db->getRepository('AppBundle:products')->find($id);
        $image = $db->getRepository('AppBundle:imageProduct')->findBy(['idProduct' => $id]);
        $stock = $db->getRepository('AppBundle:stock')->findBy(['idProduct' => $id]);

        return $this->render('AppBundle:AdminArticle:update_article.html.twig', array(
            'category' => $category,
            'product' => $product,
            'image' => $image,
            'stock' => $stock
        ));
    }
    /**
     * @Route("admin/update_article/go/{id}")
     */
    public function UpdateArticleGoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $_POST;
        $name = $_POST['name'];
        $describ = $_POST['describ'];
        $feature = $_POST['feature'];
        $color = $_POST['color'];
        $weigth = $_POST['weigth'];
        $price_HT = $_POST['price_HT'];
        $price_TTC = $_POST['price_HT']+($_POST['price_HT']*20/100);
        $statut = $_POST['statut'];
        $idCat = $_POST['category'];
        $stocks = $_POST['stock'];
        $db = $this->getDoctrine()->getManager();
        $product = $db->getRepository('AppBundle:products')->find($id);
        //$product = new Product();
        $product->setName($name);
        $product->setDescrib($describ);
        $product->setFeature($feature);
        $product->setColor($color);
        $product->setWeigth($weigth);
        $product->setPriceHT($price_HT);
        $product->setPriceTTC($price_TTC);
        $product->setStatutProduct($statut);
        $em->persist($product);
        $em->flush();

        $this->imageCheck($id);
        $stat = $em->getRepository('AppBundle:stock')->findOneBy(['idProduct' => $id]);
        if(count($stat) == 0){
            $stat = new stock();
            $stat->setIdProduct($id);
        }
        $stat->setStock($stocks);
        $stat->setDateModif(new \DateTime('now'));

        $em->persist($stat);
        $em->flush();
        return $this->render('AppBundle:AdminArticle:update_article_go.html.twig', array(
            'a'=>$a
        ));
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    private function imageCheck($idProduct){
        if(!$_FILES = $this->reArrayFiles($_FILES)){
            return false;
        }
        $arrayFile = [];
        foreach ($_FILES as $i => $val) {
            try {
                if ($_FILES[$i]['size'] > 10000000000) {
                    throw new RuntimeException('Exceeded filesize limit.');
                }
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search(
                        $finfo->file($_FILES[$i]['tmp_name']),
                        array(
                            'jpg' => 'image/jpeg',
                            'png' => 'image/png',
                            'gif' => 'image/gif',
                        ),
                        true
                    )) {
                    throw new RuntimeException('Invalid file format.');
                }
                $name = sha1($_FILES[$i]['tmp_name']) . "." . str_replace("image/", "", $_FILES[$i]['type']);
                $link = "/images_products/" . $name;
                move_uploaded_file($_FILES[$i]['tmp_name'], ".".$link);
                $arrayFile[] = $name;
                $em = $this->getDoctrine()->getManager();
                $image = new imageProduct();
                $image->setImage($link);
                $image->setIdProduct($idProduct);
                $em->persist($image);
                $em->flush();
            } catch (RuntimeException $e) {

                echo $e->getMessage();

            }
        }
        $arrayFile = json_encode($arrayFile);
        return $arrayFile;
    }
    private function reArrayFiles( &$file_post )
    {
        $file_name = 'image';
        $keys = array_keys($file_post[$file_name]);
        $file_array = array();
        $i=0;
        foreach ($file_post[$file_name][$keys[0]] as $keyss) {
            foreach ($keys as $key){
                $file_array[$i][$key] = $file_post[$file_name][$key][$i];
            }
            $i++;
        }
        if($file_array[0]['name'] == ""){
            return false;
        }
        arsort($file_array);
        return $file_array;
    }

}
