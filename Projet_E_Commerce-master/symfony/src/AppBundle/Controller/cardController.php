<?php

namespace AppBundle\Controller;

use AppBundle\Entity\card;
use AppBundle\Entity\Task;
use AppBundle\Form\cardType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class cardController extends Controller
{
    /**
     * @Route("/newCard")
     */
    public function newCardAction(Request $request)
    {
        $post = new card();
        $form = $this->createForm(CardType::class, $post);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Ajouter'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $_POST['appbundle_card']['numberCard']=str_replace(" ","", $_POST['appbundle_card']['numberCard']);
            $tousOk = true;
            $regCb = '#^[0-9]{16}$#';
            $regCsv= "#^[0-9]{3}$#";
            $regDate = "#^[0-9]{2}\/[0-9]{2}$#";
            $regName = "#^[a-zA-Z]{2,} [a-zA-Z]{2,}$#";
            if(!preg_match($regCb, $_POST['appbundle_card']['numberCard'])){
                $tousOk = false;
                $this->addFlash("alert","Le numero de carte bleu semble erroné");
            }
            if(!preg_match($regCsv , $_POST['csv'] )){
                $tousOk = false;
                $this->addFlash("alert","Le numero de cryptogramme semble erroné");
            }
            if(!preg_match($regDate,$_POST['appbundle_card']['dateExpir'])){
                $tousOk = false;
                $this->addFlash("alert", "La date ne s'emble pas etre au bon format");
            }
            if(!preg_match($regName, $_POST['appbundle_card']['nameUserCard'])){
                $tousOk = false;
                $this->addFlash("alert", "Le nom du proprietaire ne semble pas valide");
            }

            if($tousOk){
                $post->setNumberCard($this->cryptCard($_POST['appbundle_card']['numberCard'], $_POST['csv']));
                $post->setUser($this->getUser());
                $post->setIdUser($this->getUser()->getId());

                $orm = $this->getDoctrine()->getManager();
                $orm->persist($post);
                $orm->flush();
                $this->addFlash("alert","Votre carte a bien été enregister");
                return $this->redirect("/profile/");
            }
        }
        return $this->render('AppBundle:card:new_card.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    private function cryptCard($card, $key){
        $plus = 0;
        for($i = 0; $i < strlen($key);$i++){
            $plus += $key[$i];
        }
        $plus *= $key[1];
        $newString = '';
        for($i = 0; $i < strlen($card); $i++){
            $newString.= decbin(ord($card[$i])+$plus)."_";
        }
        $card= "";
        for($i = 0; $i < strlen($newString); $i++){
            if($newString[$i] == '0'){
                $card .= "*##*";
            }
            else if($newString[$i] == '1'){
                $card .= "*#*";
            }
            else{
                $card .= "_";
            }
        }
        $card = trim($card);
        return $card;
    }
    public function decryptCard($card, $key){
        $plus = 0;
        for($i = 0; $i < strlen($key);$i++){
            $plus += $key[$i];
        }
        $plus *= $key[1];
        $newText = str_replace("##", '2',$card);
        $newText = str_replace("#", '1', $newText);
        $newText = str_replace("2", '0',$newText);
        $newText = str_replace("*", "", $newText);
        $newText = str_replace("_", " ", $newText);
        $array = explode(" ", $newText);
        $card = "";
        foreach ($array as $value){
            if($value != ""){
                $tmp = bindec($value)-$plus;
                $card .=chr($tmp);
            }

        }
        return $card;
    }

    /**
     * @Route("/deleteCard")
     */
    public function deleteCardAction()
    {
        var_dump($_POST);
        $orm = $this->getDoctrine()->getManager();
        foreach ($_POST as $value){
            $select = $orm->getRepository("AppBundle:card")->findOneBy(["id_card"=>$value]);
            var_dump($select->getIdUser());
            $orm->remove($select);
            $orm->flush();
        }
        $this->addFlash("alert", "Les cartes selectioner on bien été suprimer");
        return $this->redirect("/profile/");
    }

}
