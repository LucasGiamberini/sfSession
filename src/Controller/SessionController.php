<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Repository\SessionRepository;
use App\Repository\ProgrammeRepository;
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

    #[Route('/session/{id} ' , name:'show_session')]
    public function show (Session $session, ProgrammeRepository $programme,Formateur $formateur): Response
    {   


        $resultatProgramme=$programme->findBy(['session' => "$session"] );
        
        return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            'formateur' => $formateur
        ]);
    }
}
