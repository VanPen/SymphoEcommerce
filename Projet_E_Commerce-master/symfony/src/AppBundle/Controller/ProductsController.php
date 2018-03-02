<?php

namespace AppBundle\Controller;

use AppBundle\Entity\products;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Visit;



class ProductsController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        //$image = $orm->getRepository('AppBundle:imageProduct')->find($id);
        $orm = $this->getDoctrine()->getManager();

        $request = Request::createFromGlobals();
        $ip = $request->getClientIp();
        $agentClient = str_replace(';', '', $request->headers->get('User-Agent'));

        $visit = new Visit();

        $visit->setAdressIp($ip);
        $visit->setAgentClient($agentClient);
        $visit->setLastConnection(new \DateTime('now'));

        $orm->persist($visit);

        $orm->flush();

        $repo = $orm->getRepository("AppBundle:products")->findBy(array(), array('id_product'=>'desc'),6);
        /*SELECT * FROM `products` INNER JOIN image_product ON products.id_product = image_product.id_product*/
        $cat = $orm->getRepository('AppBundle:category')->findAll();
        $em2 = $this->getDoctrine()->getManager();
        $query = "SELECT * FROM `products` LEFT JOIN image_product ON products.id_product = image_product.id_product ORDER BY products.`id_product` DESC LIMIT 20 ";
        $statement = $em2->getConnection()->prepare($query);
        $statement->execute();
        $image = $statement->fetchAll();
        $deja = [];
        foreach ($image as $value){
            if(count($deja) < 6){
                ;
                if(!isset( $deja[$value['ref']] ) ){
                    $deja[$value['ref']] =  $value;
                }
            }
        }
        return $this->render('default/index.html.twig', array(
            "res" => $repo,
            "image"=>$deja,
            'cat' => $cat
        ));
    }

    /**
     * @Route("/result")
     */
    public function SearchAction(Request $request)
    {
        $blabla ="";

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM products  LEFT JOIN image_product ON products.id_product = image_product.id_product WHERE products.name LIKE '%".$_POST['product']."%'";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();
        if($result != $_POST['product']){
            $blabla = "No result";

        }
        $em2 = $this->getDoctrine()->getManager();
        $query = "SELECT * FROM category WHERE category.id_cat";
        $statement = $em2->getConnection()->prepare($query);
        $statement->execute();
        $result2 = $statement->fetch();

        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $resultt = $paginator->paginate(
            $result,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 15)
        );

        return $this->render('AppBundle:Search:result.html.twig', array(
            'coucou'=>$blabla,
            "recoucou" => $resultt,
            'good' => $result2,
            'search' => $_POST['product'],
        ));



    }
    /**
     * @Route("/fiche_prod/{id}")
     */
    public function affProd($id){

        $orm = $this->getDoctrine()->getManager();
        $repo = $orm->getRepository("AppBundle:products")->findAll($id);
        $repo2 = $orm->getRepository("AppBundle:products")->find($id);
        $repo3 = $orm->getRepository("AppBundle:imageProduct")->findBy(["idProduct" => $id]);
        return $this->render('AppBundle:Search:fiche_prod.html.twig', array(
            'product' => $repo,
            'test'=>$repo2,
            'image' => $repo3

        ));

    }
    /**
     * @Route("/result_cat/{id_cat}")
     */
    public function resultcatAction($id_cat, Request $request){

        $em2 = $this->getDoctrine()->getManager();
        $query = "SELECT * FROM products INNER JOIN categories_products ON products.id_product = categories_products.product_id INNER JOIN category ON category.id_cat = categories_products.category_id LEFT JOIN image_product ON products.id_product = image_product.id_product WHERE category.id_cat = $id_cat";
        $statement = $em2->getConnection()->prepare($query);
        $statement->execute();
        $test = $statement->fetchAll();
        $cateName = $em2->getRepository('AppBundle:category')->find($id_cat);

        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $test,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 15)
        );

        return $this->render('AppBundle:Search:result_cat.html.twig', array(
            'test' => $result,
            'cateName' => $cateName,
        ));
    }

}