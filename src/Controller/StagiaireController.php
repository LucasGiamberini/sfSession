<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
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


    #[Route('/stagiaire/{id}/show ' , name:'show_stagiaire')]
    public function show ( Stagiaire $stagiaire, SessionRepository $sessionRepo,Session $session): Response
    {   
        $idStagiaire=$stagiaire->getId();
       
      
       $sessionSub=$session->getStagiaires(['sessions' => "$idStagiaire"]);
       
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire'=> $stagiaire, 
            'session'=> $sessionSub
        ]);
    }
}
