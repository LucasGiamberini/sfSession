<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\FormModule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbJours', IntegerType::class,[
            'label' => 'Durée en Jours' ,
             'attr' => [ 'min' => 1 , 'max' => 100 ]])
      //      ->add('session',hiddenType::class ,EntityType::class, [
        //        'class' => Session::class,
         //   'choice_label' => 'id',
           // ])
            ->add('module', EntityType::class, [
                'label' => 'module',
                'class' => FormModule::class,  
            'choice_label' => 'nomModule',
            ])
      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
