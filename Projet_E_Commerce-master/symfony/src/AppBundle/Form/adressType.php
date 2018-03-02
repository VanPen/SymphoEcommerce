<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class adressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder->add('nameAdress', null, array('label' => 'Nom de l\'adresse : ','attr' => array(
            'placeholder' => 'Ex : Maison , Travail , ...',
        )))->
        add('nameDesti', null, array('label' => 'Nom du destinataire : ','attr' => array(
            'placeholder' => 'Ex : Jean Dupond',
        )))->
        add('adress', null, array("label" => "Adresse postale : ",'attr' => array(
            'placeholder' => 'Ex : 2 rue du fromage',
        )))->
        add('cp', null, array('label' => "Code Postal : ", 'attr' => array(
            'placeholder' => '69000',
        )))->
        add('city', null, array('label' => "Ville : ", 'attr' => array(
            'placeholder' => 'Lyon',
        )))->
        add('country', null, array('label' => "Pays : ", 'attr' => array(
            'placeholder' => 'France',
        )));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\adress'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_adress';
    }


}
