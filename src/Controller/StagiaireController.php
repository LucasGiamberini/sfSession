<?php

namespace App\Controller;

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


    #[Route('/stagiaire/{id} ' , name:'show_stagiaire')]
    public function show ( StagiaireRepository $programme): Response
    {   


       
        
        return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            'formateur' => $formateur
        ]);
    }
}
