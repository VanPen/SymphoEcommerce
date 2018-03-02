<?php

namespace AppBundle\Controller;

use AppBundle\Tests\Controller\OrdersControllerTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Stripe\Stripe;
use AppBundle\Entity\orders;
use AppBundle\Entity\sales;

class clientOrderController extends Controller
{
    /**
     *@Route("/newCommande");
     */
    public function newCommandeAction(){
        $orm = $this->getDoctrine()->getManager();

        if(isset($_POST['adress']) && $_POST['adress'] !== "") {
            if (isset($_POST['card'])) {

                $card = $orm->getRepository("AppBundle:card")->findOneBy(["id_card" => $_POST['card']]);
            } else {
                $card = false;

            }
        }
        else{
            $this->addFlash("alert", "Vous n'avez pas ajouté d'adresse ! ");
            return $this->redirect("/endBasket");
        }

        return $this->render('AppBundle:clientOrder:decrypt.html.twig', array(
             'card' => $card,
             "post" => $_POST,
         ));
    }

    /**
     * @Route("/decryptMe")
     */
    public function decryptCard(){
        $orm = $this->getDoctrine()->getManager();
        if(isset($_POST['card'])){
            $card = $orm->getRepository("AppBundle:card")->findOneBy(["id_card"=>$_POST['card']]);
            $nbCard = $decrypte->decryptCard($card->getNumberCard(),$_POST['csv']);

        }
        else{
            $card = [];
            $nbCard = 000000000;
        }
        $adress = $orm->getRepository("AppBundle:adress")->findOneBy(['id_adress' => $_POST['adress']]);
        $decrypte = new cardController();
        $basket = $orm->getRepository("AppBundle:basket")->findOneBy(['userId' =>$this->getUser()->getId(),'statusBasket' => 1]);

        return $this->render('AppBundle:clientOrder:payment.html.twig', array(
            'card' => $card,
            "adress" => $adress,
            'nbCard' => $nbCard,
            'user' => $this->getUser(),
            'basket' => $basket,
        ));
    }
    /**
     * @Route("/payment")
     */
    public function payment()
    {
        $orm = $this->getDoctrine()->getManager();
        $basket = $orm->getRepository("AppBundle:basket")->findOneBy(['userId' =>$this->getUser()->getId(),'statusBasket' => 1]);
        Stripe::setApiKey("sk_test_np4OcJgL9o9vAPyQxgZ9hqXf");
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create(array(
            "amount" => str_replace('.', '',$basket->getTotalTTC()).'0',
            "currency" => "eur",
            "description" => "Example charge",
            "source" => $token,
        ));
        $basket->setStatusBasket(2);
        $orm->persist($basket);
        $orm->flush();
        $this->addFlash("alert", "Le payment à bien été accepté");

        $this->addOrders($_POST["adress"],$_POST['basket']);

        $sale = new sales();
        $sale->setDateCreated(new \DateTime('now'));
        $sale->setTotal($basket->getTotalTTC());

        $orm->persist($sale);
        $orm->flush();
        return $this->redirect("/profile");
    }

    public function addOrders($idAdress, $idBasket)
    {
        $db = $this->getDoctrine()->getManager();
        $basket = $db->getRepository('AppBundle:basket')->find($idBasket);
        $adress = $db->getRepository('AppBundle:adress')->find($idAdress);

        $orders = new orders;
        $orders->setUser($this->getUser());
        $orders->setOrderStatus("2");
        $orders->setTotalTTC($basket->getTotalTTC());
        $orders->setTotalHT($basket->getTotalHT());
        $orders->setNbProduct($basket->getProductNumbers());
        $orders->setTotalWeight($basket->getTotalWeight());
        $orders->setDateOrder(new \DateTime('now'));
        $orders->setAdresses($adress);
        $orders->setBasketes($basket);

        $db->persist($orders);
        $db->flush();
        return true;
    }

    /**
     * @Route("/order/client/{id}")
     */
    public function displayOrderAction($id)
    {
        $db = $this->getDoctrine()->getManager();
        $orders = $db->getRepository('AppBundle:orders')->findBy    (['idUser' => $id]);


        return $this->render('AppBundle:clientOrder:orders.html.twig', array(
            'orders' => $orders,
        ));
    }

    /**
     * @Route("order/details/{id}")
     */
    public function detailsOrderAction($id)
    {
        $db = $this->getDoctrine()->getManager();
        $order = $db->getRepository('AppBundle:orders')->find($id);
        $basketId = $order->getBasketId();
        $basket = $db->getRepository('AppBundle:basket')->find($basketId);

        return $this->render('AppBundle:clientOrder:order_details.html.twig', array(
            'order' => $order,
        ));
    }
}
