<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\AjoutStagiaireType;
use App\Form\AddStagiaireSessionType;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(StagiaireRepository $stagiairesRepository): Response
    {   
        $stagiaire= $stagiairesRepository->findBy([], ["nom" => "Asc"]);
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaire ,
        ]);
    }

    #[Route('/stagiaire/{id}/addSession ' , name:'addSession_stagiaire')]
    public function addStagiaire( Stagiaire $stagiaire, Request $request ,EntityManagerInterface $entityManager,Session $sessions ): Response
    {
        
        $form=$this->createForm(AddStagiaireSessionType::class,$sessions);

       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           

            $session = $form->getData();// recueille les donner du formulaire

            $stagiaire->addSession($session); //prepare les donner

           
     

            return $this->redirectToRoute('app_stagiaire');

        }
        
        
        return $this->render('stagiaire/addSession.html.twig', [ 'formAdd' => $form]);
    }


    #[Route('/stagiaire/new', name:'new_stagiaire')]
    public function new(Stagiaire $stagiaire=NULL ,Request $request,EntityManagerInterface $entityManager  ): Response
    {
        $form=$this->createForm(AjoutStagiaireType::class,$stagiaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $session = $form->getData();// recueille les donner du formulaire

            $entityManager->persist($session); //prepare les donner

           
            $entityManager->flush();

            return $this->redirectToRoute('app_stagiaire');

        }

        return $this->render('stagiaire/new.html.twig', [ 'formAdd' => $form]);
    }


    #[Route('/stagiaire/{id}/show ' , name:'show_stagiaire')]
    public function show ( Stagiaire $stagiaire,StagiaireRepository $stagiairesRepository, SessionRepository  $sessionRepository): Response
    {   
      //  $idStagiaire=$stagiaire->getId();
       $session = $stagiaire->getSessions();
   //   var_dump($sessionRepo->findby(['stagiaires' => "$stagiaire" ])); die();
   //    $sessionSub=$sessionRepo->findBy(['stagiaires' => "$stagiaire"]);
   //$session= $sessionRepository->findBy(["stagiaires" => "$stagiairesRepository"],["intitule"=> "ASC"]);
//   $session=$sessionRepository->findBy(['stagiaires' => "$stagiaire"]);
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire'=> $stagiaire, 
          'sessions'=>  $session
        ]);
    }

  
}
