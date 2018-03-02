<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Entity\adress;
use AppBundle\Form\adressType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdressController extends Controller
{
    /**
     * @Route("/adress/new")
     */
    public function newAction(Request $request)
    {
        $post = new adress();
        $form = $this->createForm(AdressType::class, $post);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Ajouter'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orm = $this->getDoctrine()->getManager();
            $post->setUser($this->getUser());
            $post->setVisible(1);
            $orm->persist($post);
            $orm->flush();

            return $this->redirect("/");
        }
        return $this->render('AppBundle:Adress:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/adress/update/{id}")
     */
    public function modifAction(Request $request ,$id)
    {
        $orm = $this->getDoctrine()->getManager();
        $adresse = $orm->getRepository("AppBundle:adress")->findOneBy(array("id_adress" => $id));
        if($adresse == NULL){
            $this->addFlash("info", "Une erreur c'est produite");
            return $this->redirect("/profile");
        }
        if($this->getUser()->getId() != $adresse->getUser()->getId()){
            $this->addFlash("info", "Vous n'êtes pas autoriser");
            return $this->redirect('/profile');
        }
        $form = $this->createForm(AdressType::class, $adresse);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Modifier'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orm = $this->getDoctrine()->getManager();
            $orm->persist($adresse);
            $orm->flush();
            $this->addFlash("info", "L'adresse a bien été modifier");
            return $this->redirect("/profile");
        }
        return $this->render('AppBundle:Adress:modif.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/adress/remove/{id}")
     */
    public function deleteAction($id){
        $orm = $this->getDoctrine()->getManager();
        $adresse = $orm->getRepository("AppBundle:adress")->findOneBy(array("id_adress" => $id));
        if($adresse == null){
            $this->addFlash("info", "Une erreur c'est produite");
            return $this->redirect("/");
        }
        if($this->getUser()->getId() != $adresse->getUser()->getId()){
            $this->addFlash("info", "Vous n'êtes pas autoriser");
            return $this->redirect('/profile');
        }
        $adresse->setVisible('0');
        $orm->persist($adresse);
        $orm->flush();
        $this->addFlash("info", "Votre adresse a bien été suprimer");
        return $this->redirect('/profile');
    }

}
