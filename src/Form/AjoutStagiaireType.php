<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AjoutStagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe')
            ->add('ville')
            ->add('email')
            ->add('telephone')
            ->add('DateNaissance',DateType::class,
            [ 'widget' => 'single_text']) 
     //      ->add('sessions', EntityType::class, [
       //         'class' => Session::class,
         //       'choice_label' => 'intitule',
          //  ])
            ->add('Valider' , SubmitType::class,
              ['attr'=> ['class' => 'btn btn-success']]) 
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
