<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\AjoutSessionType;
use App\Repository\SessionRepository;
use App\Repository\ProgrammeRepository;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository  ): Response
    {   
        $session= $sessionRepository->findBy([],["intitule"=> "ASC"]);
        return $this->render('session/index.html.twig', [
            'sessions' => $session ,
        ]);
    }

    #[Route('/session/new', name:'new_session')]
    public function new(Session $session=NULL ,Request $request,EntityManagerInterface $entityManager  ): Response
    {
        $form=$this->createForm(AjoutSessionType::class,$session);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $session = $form->getData();// recueille les donner du formulaire

            $entityManager->persist($session); //prepare les donner

           
            $entityManager->flush();

            return $this->redirectToRoute('app_session');

        }

        return $this->render('session/new.html.twig', [ 'formAdd' => $form]);
    }

    #[Route('/session/{id} ' , name:'show_session')]
    public function show (Session $session, ProgrammeRepository $programme, StagiaireRepository $Stagiaire): Response
    {   

      //  $resultatStagiaire=$Stagiaire->findBy(['sessions' => "$session"]);
        $resultatProgramme=$programme->findBy(['session' => "$session"] );
        
        return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            
        ]);
    }
}
