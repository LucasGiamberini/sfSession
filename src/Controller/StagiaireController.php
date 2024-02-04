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
    public function show ( Stagiaire $stagiaire,StagiaireRepository $stagiairesRepository, SessionRepository  $sessionRepository): Response
    {   
      //  $idStagiaire=$stagiaire->getId();
       
   //   var_dump($sessionRepo->findby(['stagiaires' => "$stagiaire" ])); die();
   //    $sessionSub=$sessionRepo->findBy(['stagiaires' => "$stagiaire"]);
   //$session= $sessionRepository->findBy(["stagiaires" => "$stagiairesRepository"],["intitule"=> "ASC"]);
//   $session=$sessionRepository->findBy(['stagiaires' => "$stagiaire"]);
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire'=> $stagiaire, 
  //          'session'=>  $session
        ]);
    }
}
