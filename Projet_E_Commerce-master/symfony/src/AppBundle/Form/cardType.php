<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class cardType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numberCard' ,null, array('label' => 'Numéro de votre carte : ','attr' => array(
            'placeholder' => '42424242424242',
        )))->add('nameUserCard',null, array('label' => 'Nom du proprietaire : ','attr' => array(
            'placeholder' => 'Jean Dupon',
        )))->add('dateExpir',null, array('label' => 'Date d\'expiration : ','attr' => array(
            'placeholder' => '09/10',
        )));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\card'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_card';
    }


}
