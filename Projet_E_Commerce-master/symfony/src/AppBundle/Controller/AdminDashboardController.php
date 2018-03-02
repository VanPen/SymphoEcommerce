<?php

namespace AppBundle\Controller;

use Doctrine\Common\Annotations\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\category;


class AdminDashboardController extends Controller
{
    /**
     * @Route("/admin/index")
     * @Route("/admin")
     */
    public function indexAction(Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $order = $db->getRepository('AppBundle:orders')->findAll();
        $visit = "SELECT * FROM `visit`";
        $statement = $db->getConnection()->prepare($visit);
        $statement->execute();
        $visit = $statement->rowCount();

        $sale = "SELECT * FROM `sales`";
        $statement = $db->getConnection()->prepare($sale);
        $statement->execute();
        $sale = $statement->rowCount();

        $allOrders = "SELECT * FROM `orders`";
        $statement = $db->getConnection()->prepare($allOrders);
        $statement->execute();
        $allOrders = $statement->rowCount();

        $revenue = "SELECT SUM(`total`) FROM `sales`";
        $statement = $db->getConnection()->prepare($revenue);
        $statement->execute();
        $revenue = $statement->fetchAll();
        $revenue = $revenue[0]['SUM(`total`)'];

        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $order,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        $userMonth = "SELECT * FROM `visit` WHERE MONTH(`last_connection`) = MONTH(NOW())";
        $statement = $db->getConnection()->prepare($userMonth);
        $statement->execute();
        $userMonth = $statement->rowCount();
        setcookie('CookMonth', $userMonth);

        $userLastYear = "SELECT * FROM `visit`WHERE YEAR(`last_connection`) = '2017'";
        $statement = $db->getConnection()->prepare($userLastYear);
        $statement->execute();
        $userLastYear = $statement->rowCount();
        setcookie('CookLastYear', $userLastYear);


        $userWeek = "SELECT * FROM `visit` WHERE MONTH(`last_connection`) = MONTH(NOW()) AND DAY(NOW()) - 7 <= DAY(`last_connection`)";
        $statement = $db->getConnection()->prepare($userWeek);
        $statement->execute();
        $userWeek = $statement->rowCount();
        setcookie('CookWeek', $userWeek);


        $saleToday = "SELECT SUM(`total`) FROM `sales` WHERE DATE(`date_created`) = DATE(NOW())";
        $statement = $db->getConnection()->prepare($saleToday);
        $statement->execute();
        $saleToday = $statement->fetchAll();
        setcookie('saleToday', $saleToday[0]['SUM(`total`)']);

        $sale1 = "SELECT SUM(`total`) FROM `sales` WHERE DATE(`date_created`) = DATE(NOW())-1";
        $statement = $db->getConnection()->prepare($sale1);
        $statement->execute();
        $sale1 = $statement->fetchAll();
        setcookie('sale1', $sale1[0]['SUM(`total`)']);

        $sale2 = "SELECT SUM(`total`) FROM `sales` WHERE DATE(`date_created`) = DATE(NOW())-2";
        $statement = $db->getConnection()->prepare($sale2);
        $statement->execute();
        $sale2 = $statement->fetchAll();
        setcookie('sale2', $sale2[0]['SUM(`total`)']);

        $sale3 = "SELECT SUM(`total`) FROM `sales` WHERE DATE(`date_created`) = DATE(NOW())-3";
        $statement = $db->getConnection()->prepare($sale3);
        $statement->execute();
        $sale3 = $statement->fetchAll();
        setcookie('sale3', $sale3[0]['SUM(`total`)']);

        $sale4 = "SELECT SUM(`total`) FROM `sales` WHERE DATE(`date_created`) = DATE(NOW())-4";
        $statement = $db->getConnection()->prepare($sale4);
        $statement->execute();
        $sale4 = $statement->fetchAll();
        setcookie('sale4', $sale4[0]['SUM(`total`)']);

        $sale5 = "SELECT SUM(`total`) FROM `sales` WHERE DATE(`date_created`) = DATE(NOW())-5";
        $statement = $db->getConnection()->prepare($sale5);
        $statement->execute();
        $sale5 = $statement->fetchAll();
        setcookie('sale5', $sale5[0]['SUM(`total`)']);





        return $this->render('AppBundle:AdminDashboard:index.html.twig', array(
            'orders' => $result,
            'revenue' => $revenue,
            'allOrders' => $allOrders,
            'visit' => $visit,
            'sale' => $sale,
        ));
    }

    /**
     * @Route("/admin/categories")
     */
    public function categoriesAction(Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $category = $db->getRepository('AppBundle:category')->findAll();

        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $category,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 15)
        );

        return $this->render('AppBundle:AdminDashboard:categories.html.twig', array(
            'categories' => $result,
        ));
    }

    /**
     * @Route("/admin/categorie/{id}")
     */
    public function displayCategory($id, Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $query = "SELECT * FROM products,category,categories_products WHERE products.id_product=product_id AND category_id=category.id_cat AND category_id =".$id;
        $statement = $db->getConnection()->prepare($query);
        $statement->execute();

        $product = $statement->fetchAll();
        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $product,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 15)
        );

        return $this->render('AppBundle:AdminDashboard:show_category.html.twig', array(
            'products' => $result,
        ));
    }

    /**
     * @Route("/admin/product/{id}")
     */
    public function showProduct($id)
    {
        $db = $this->getDoctrine()->getManager();
        $product = $db->getRepository('AppBundle:products')->find($id);
        $image = $db->getRepository('AppBundle:imageProduct')->findByIdProduct($id);

        return $this->render('AppBundle:AdminDashboard:show_product.html.twig', array(
            'product' => $product,
            'image' => $image,

        ));
    }

    /**
     * @Route("/admin/modified/statut/product/{id}")
     */
    public function modifiedStatut($id, Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $prod = $db->getRepository('AppBundle:products')->find($id);

        $prod = $prod->setStatutProduct('0');
        $prod = $prod->setDateModif(new \DateTime('now'));

        $db->persist($prod);
        $db->flush();


        $id_cat = $prod->getCategories()[0]->getId_Cat();
        $product = $db->getRepository('AppBundle:products')->findAll();


        return $this->redirect("/admin/categorie/$id_cat");
    }

    /**
     * @Route("/admin/add/category")
     */
    public function addCateAction()
    {

        return $this->render('AppBundle:AdminDashboard:add_category.html.twig', array(
            //;;;;
        ));
    }

    /**
     * @Route("/admin/add/category_submit")
     */
    public function addCateSubmitAction()
    {
        $db = $this->getDoctrine()->getManager();

        $category = new category();
        $category->setDescrib($_POST['describe']);
        $category->setNameCat($_POST['name']);
        $category->setIdParent('0');

        $db->persist($category);
        $db->flush();

        return $this->redirect("/admin/categories");
    }
    /**
     * @Route("/admin/delete/multiple")
     */
    public function deleteAction()
    {
        for ($i=0;$i<count($_POST['choix']);$i++) {
            $choix = $_POST['choix'][$i];
            $db = $this->getDoctrine()->getConnection();

            $conn = $this->getDoctrine()->getConnection();
            $query = "DELETE FROM `categories_products` WHERE `product_id` = ".$choix;
            $stmt = $conn->prepare($query);
            $stmt->execute();

            $conn = $this->getDoctrine()->getConnection();
            $sql = "DELETE FROM `products` WHERE `id_product` = ".$choix;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        return $this->redirect("/admin/categorie/".$_POST['id_cat']);
    }
}

