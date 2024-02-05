<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\AjoutSessionType;
use App\Controller\SessionController;
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

    #[Route('/session/{id}/show ' , name:'show_session')]
    public function show (Session $session, ProgrammeRepository $programme, StagiaireRepository $stagiairesRepository): Response
    {   $id=$session->getId();
        
       // $stagiaireNonInscrit= $session->findByStagiairesNotInSession($id);
      //  $resultatStagiaire=$Stagiaire->findBy(['sessions' => "$session"]);
        $resultatProgramme=$programme->findBy(['session' => "$session"] );
        $stagiaire= $stagiairesRepository->findBy([], ["nom" => "Asc"]);
        return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            'stagiaires' => $stagiaire, 
       //     'stagiaireNonInscrit' => $stagiaireNonInscrit
        ]);
    }

    #[Route('/session/{id} ' , name:'addStagiaire_session')]
    public function addStagiaire( Stagiaire $stagiaire,Session $session,ProgrammeRepository $programme, StagiaireRepository $stagiairesRepository){
       $idStagiaire=$_GET["idStagiaire"];
        $idsession=$session->getId();
        $objectStagiaire=$stagiairesRepository->findBy(["id" => $idStagiaire]);
        var_dump($objectStagiaire);
        echo $idsession ; die();
       
        $session->addStagiaire($stagiaire);
       $stagiaire->addSession($session);
       
       



       $resultatProgramme=$programme->findBy(['session' => "$session"] );
        $stagiaire= $stagiairesRepository->findBy([], ["nom" => "Asc"]);
       return $this->render('session/show.html.twig', [
        'session'=> $session, 
        'programmes' => $resultatProgramme,
        'stagiaires' => $stagiaire 
    ]);
    }

    public function findByStagiairesNotInSession(int $id)
    {
        $em = $this->getEntityManager(); // get the EntityManager
        $sub = $em->createQueryBuilder(); // create a new QueryBuilder
    }
}
