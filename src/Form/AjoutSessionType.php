<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use App\Entity\FormModule;
use App\Form\ProgrammeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AjoutSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut')
            ->add('dateFin')
            ->add('nbPlace')
            ->add('intitule')
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
'choice_label' => 'intutitule_formation',
            ])
            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
'choice_label' => 'nom'
            ])
            ->add('programmes',CollectionType::class,[
             
                'entry_type' => ProgrammeType::class,
                'prototype' => true,
                // on va autoriser l'ajout d'un nouvelle element dans session qui seront persister grace au persiste
                //on va activer un data prototype qui sera un attribut html sur lequel on pourra manipuler avec javascript
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,  // il est obligatoire car session n'a pas de setProgramme mais c'est session qui contient setProgramme
                //c'est programme qui est propriétaire de la relation
                //pour eviter un mappping false on est obliger de rajouter un by_reference
                ])   
     //       ->add('stagiaires', EntityType::class, [
     //           'class' => Stagiaire::class,
//'choice_label' => 'nom',   
  //          ])
            ->add('Valider' , SubmitType::class,  ['attr'=> ['class' => 'btn btn-success']]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
