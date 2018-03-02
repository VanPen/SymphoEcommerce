<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminUsersController extends Controller
{
    /**
     * @Route("/admin/users_list")
     */
    public function listUsersAction(Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $users = $db->getRepository('AppBundle:users')->findAll();

        /**
         * @var $paginator\Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );


        return $this->render('AppBundle:AdminUsers:list_users.html.twig', array(
            'users' => $result,
        ));
    }

    /**
     * @Route("/admin/user/{id}")
     */
    public  function userAction($id)
    {
        $db = $this->getDoctrine()->getManager();
        $user = $db->getRepository('AppBundle:users')->find($id);
        $orders = $db->getRepository('AppBundle:orders')->findByIdUser($id);
        $adress = $db->getRepository('AppBundle:adress')->findByUser($id);

        return $this->render('AppBundle:AdminUsers:user_info.html.twig', array(
            'user' => $user,
            'orders' => $orders,
            'adresses' => $adress,
        ));
    }

}
