<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\orders;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    /**
     * @Route("/admin/manage_order/{id}")
     */
    public function manageOrderAction($id)
    {
        $db = $this->getDoctrine()->getManager();
        $order = $db->getRepository('AppBundle:orders')->find($id);
        $id_user = $order->getIdUser();
        $orderress = $db->getRepository('AppBundle:adress')->findByUser($id_user);
        return $this->render('AppBundle:Orders:manage_order.html.twig', array(
            'order' => $order,
            'adress' => $orderress,
        ));
    }

    /**
     * @Route("/admin/manage_order/{id}/submit")
     */
    public function submitManage($id)
    {
        $db = $this->getDoctrine()->getManager();
        $order = $db->getRepository('AppBundle:orders')->find($id);
        $id_user = $order->getIdUser();
        $orderress = $db->getRepository('AppBundle:adress')->findByUser($id_user);

        $order->setTotalWeight($_POST['totalWeight']);
        $order->setOrderStatus($_POST['status']);
        $order->setIdAdress($_POST['adress']);
        $db->persist($order);
        $db->flush();

        return $this->redirect('/admin/user/'.$id_user);

    }

    /**
     * @Route("/admin/orders")
     */
    public function allOrdersAcion(Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $order = $db->getRepository('AppBundle:orders')->findAll();

        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $order,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 15)
        );


        return $this->render('AppBundle:Orders:all_orders.html.twig', array(
            'orders' => $result,
        ));
    }
    /**
     * @Route("/admin/export")
     */
    public function exportAction()
    {
        $db = $this->getDoctrine()->getManager();
        $orders = $db->getRepository('AppBundle:orders')->findAll();

        // ask the service for a excel object
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        $sheet = $phpExcelObject->setActiveSheetIndex(0);
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Price HT');
        $sheet->setCellValue('D1', 'Price TTC');
        $sheet->setCellValue('E1', 'No Products');
        $sheet->setCellValue('F1', 'Total Weight');

         $lignes = 2;
    $phpExcelObject->setActiveSheetIndex(0);
    foreach ($orders as $order){
        $phpExcelObject->getActiveSheet()
            ->setCellValue('A' . $lignes, $order->getIdOrder())
            ->setCellValue('B' . $lignes, $order->getDateOrder())
            ->setCellValue('C' . $lignes, $order->getTotalHT())
            ->setCellValue('D' . $lignes, $order->getTotalTTC())
            ->setCellValue('E' . $lignes, $order->getNbProduct())
            ->setCellValue('F' . $lignes, $order->getTotalWeight());
            $lignes++;

        }

        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // The save method is documented in the official PHPExcel library
        $writer->save('export_Excel/filename.xlsx');
        $this->addFlash("alert", "<a href='/export_Excel/filename.xlsx'>Télécharger Ici</a>");

        // Return a Symfony response (a view or something or this will thrown error !!!)
        return $this->redirect('/admin/orders');
    }

    /**
     * @Route("/admin/details/{id}")
     */
    public function detailsAction($id)
    {
        $db = $this->getDoctrine()->getManager();
        $order = $db->getRepository('AppBundle:orders')->find($id);
        $basketId = $order->getBasketId();
        $basket = $db->getRepository('AppBundle:basket')->find($basketId);

        return $this->render('AppBundle:Orders:details_order.html.twig', array(
            'order' => $order,
        ));
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
}
