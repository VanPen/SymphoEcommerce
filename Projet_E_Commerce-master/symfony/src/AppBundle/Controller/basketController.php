<?php

namespace AppBundle\Controller;

use AppBundle\Entity\basket;
use AppBundle\Entity\quantity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class basketController extends Controller
{
    /**
     * @Route("/pannier")
     */
    public function indexAction()
    {
        if($this->getUser() != null && !isset($_COOKIE['basket'])){
            return $this->render('AppBundle:basket:index.html.twig', array(
                "user" => $this->getUser(),
            ));
        }
        else{
            $basketes = $this->cookieBasket();
            if(!$basketes){
                return $this->redirect("/pannier");
            }
            return $this->render('AppBundle:basket:index.html.twig', array(
                "user" => ['basketes' => $basketes],
            ));
        }

    }
    private function cookieBasket(){
        $request = Request::createFromGlobals();
        $cookie = $request->cookies->get('basket');
        $basket = [["statusBasket" => 1,
                    'productes' => [],
                    'totalHT' => 0,
                    'totalTTC' =>0,
                    'totalWeight' => 0,
                ]];
        if($cookie != null){
            $conn = $this->getDoctrine()->getConnection();
            $basketC = json_decode($cookie, true);
            $sql = "SELECT * FROM products ";
            $i = 0;
            foreach ($basketC as $value){
                if($i == 0){
                    $sql .='WHERE id_product = '.$value['id'];
                }
                else{
                    $sql .=' OR id_product = '.$value['id'];
                }
                $i++;
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $prod = $stmt->fetchAll();
            $i = 0;
            foreach ($prod as $key => $value){
                $prod[$key]['idProduct'] = $value['id_product'];
                $prod[$key]['priceHT'] = $value['price_HT'];
                $prod[$key]['priceTTC'] = $value['price_TTC'];
                $basket[0]['totalHT'] += $value['price_HT'] * $basketC[$i]['q'];
                $basket[0]['totalTTC'] += $value['price_TTC'] * $basketC[$i]['q'];
                $basket[0]['totalWeight'] += $value['weigth'] * $basketC[$i]['q'];
                $basket[0]['quantities'][$i]['product'] = $prod[$key];
                $basket[0]['quantities'][$i]['quant'] = $this->test($value['id_product'],$basketC );
                $i++;
            }
            if($this->getUser() != null){
                $orm = $this->getDoctrine()->getManager();
                $pannier = $orm->getRepository('AppBundle:basket')->findOneBy(['userId' => $this->getUser()->getId(), "statusBasket" => 1]);
                if($pannier == null){
                    $pannier = new basket();
                    $pannier->setStatusBasket(1);
                    $pannier->setUser($this->getUser());
                    $pannier->setProductNumbers(count($prod));
                    $pannier->setTotalHT(0);
                    $pannier->setTotalTTC(0);
                    $pannier->setTotalWeight(0);

                    $orm->persist($pannier);
                    $orm->flush();
                }
                foreach ($prod as $value){
                    $prod = $orm->getRepository("AppBundle:products")->findOneBy(["id_product" => $value['id_product']]);

                    $quantity = new quantity();
                    $quantity->setQuant($this->test($value['id_product'],$basketC ));
                    $quantity->setProduct($prod);
                    $quantity->setBasket($pannier);
                    $orm->persist($quantity);
                    $orm->flush();
                }
                $pannier->setTotalHT($pannier->getTotalHT() + $basket[0]['totalHT']);
                $pannier->setTotalTTC($pannier->getTotalTTC() + $basket[0]['totalTTC']);
                $pannier->setTotalWeight($pannier->getTotalWeight() + $basket[0]['totalWeight']);
                $orm->persist($pannier);
                $orm->flush();

                setcookie("basket", null, strtotime( '-30 days' ));
                $basket = $orm->getRepository('AppBundle:basket')->findOneByUserId($this->getUser()->getId());
                return false;
            }
        }
        return $basket;
    }
    private function test($s , $array){
        foreach ($array as $value){
            if($value['id'] == $s){
                return $value['q'];
            }
        }
    }
    /**
     * @Route("/addBasket/")
     * @Route("/addBasket/{id}")
     */
    public function addBasketAction($id = null)
    {
        if($id == null){
            return $this->render('AppBundle:basket:add_basket.html.twig', array(
            ));
        }
        $request = Request::createFromGlobals();
        $cookie = $request->cookies->get('basket');
        if($cookie == null){
            $test = [ [ 'id' => $id, 'q' => $_POST['quantity'] ] ];
            setcookie("basket", json_encode($test),  strtotime( '+30 days' ), "/" );
        }
        else{
            $cookie = json_decode($cookie);
            array_push($cookie, [ 'id' => $id, 'q' => $_POST['quantity']] );
            setcookie("basket", json_encode($cookie),  strtotime( '+30 days' ) ,'/');
        }
        return  $this->redirect('/pannier');
    }

    /**
     * @Route("/clearBasket")
     */
    public function clearBasketAction()
    {
        if($this->getUser() != null){
            $orm = $this->getDoctrine()->getManager();
            $basket = $orm->getRepository('AppBundle:basket')->findOneBy(['userId' => $this->getUser()->getId(), "statusBasket" => 1]);
            $quanti = $basket->getQuantities();
            foreach ($_POST as $value){
                foreach ($quanti as $key => $val){
                    if($value == $val->getProduct()->getIdProduct()){
                        $basket->setTotalTTC($basket->getTotalTTC() - ($val->getProduct()->getPriceTTC() * $val->getQuant()));
                        $basket->setTotalHT($basket->getTotalHT() - ($val->getProduct()->getPriceHT() * $val->getQuant()));
                        $basket->setTotalWeight(round($basket->getTotalWeight() - ($val->getProduct()->getWeigth() * $val->getQuant()), 3));
                        $id = $val->getId();
                        $conn = $this->getDoctrine()->getConnection();
                        $sql = "DELETE FROM `quantity` WHERE id = ".$id;
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $orm->persist($basket);
                        $orm->flush();
                    }
                }
            }
        }
        else{
            $request = Request::createFromGlobals();
            $cookie = json_decode($request->cookies->get('basket'),true);
            foreach ($_POST as $value){
                foreach ($cookie as $key => $val){
                    var_dump($value);
                    var_dump($val);
                    if($value == $val['id']){
                        unset($cookie[$key]);
                    }
                }
            }
            sort($cookie);
            setcookie("basket", json_encode($cookie),  strtotime( '+30 days' ) ,'/');
        }
        return $this->redirect("/pannier");
    }
    /**
     * @Route("/endBasket")
     */
    public function endBasket(){
        if($this->getUser() != null){

            return $this->render("AppBundle:basket:end_basket.html.twig", array('user' => $this->getUser()));
        }
        else{
            return $this->redirect("/login");
        }
    }

}
