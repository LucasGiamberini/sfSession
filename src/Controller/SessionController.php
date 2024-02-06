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
use App\Repository\FormModuleRepository;
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
    public function show ( SessionRepository $SessionRepository,Session $session, ProgrammeRepository $programmeRepository,Programme $programme, FormModuleRepository $module, StagiaireRepository $stagiairesRepository): Response
    {   $id=$session->getId();
        $stagiaireNonInscrits= $SessionRepository->findByStagiairesNotInSession($id);

      //  $categorieProgramme=$module->findby(['categorie_id' => "$idCategorie"]);
        $resultatProgramme=$programmeRepository->findBy(['session' => "$session"] );
       $categorie=$programmeRepository->findByCategory($id);
        
       dd($categorie);
     
        
        $stagiaire= $stagiairesRepository->findBy([], ["nom" => "Asc"]);
        return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            'stagiaires' => $stagiaire, 
           'stagiaireNonInscrits' => $stagiaireNonInscrits,
            'categories' => $categorie
        ]);
    }

    #[Route('/session/{id}/{idStagiaire} ' , name:'addStagiaire_session')]
    public function addStagiaire(SessionRepository $SessionRepository,Session $session,ProgrammeRepository $programme, StagiaireRepository $stagiairesRepository, $idStagiaire,EntityManagerInterface $entityManager){
        $id=$session->getId();

        $stagiaire =  $stagiairesRepository->findOneBy(['id' => $idStagiaire]);//pour trouver l'objet stagiaire
        
        $session->addStagiaire($stagiaire);
        $stagiaire->addSession($session);
        
        $entityManager->persist($session, $stagiaire);
        $entityManager->flush();




        $resultatProgramme=$programme->findBy(['session' => $session] );
        $stagiaires= $stagiairesRepository->findBy([], ["nom" => "Asc"]);
        $stagiaireNonInscrits= $SessionRepository->findByStagiairesNotInSession($id);
        
       return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            'stagiaires' => $stagiaires ,
            'stagiaireNonInscrits' => $stagiaireNonInscrits
        ]);
    }

    #[Route('/session/{id}/{idStagiaire}/delete ' , name:'deleteStagiaire_session')]
    public function deleteStagiaire(Session $session, StagiaireRepository $stagiairesRepository, $idStagiaire,ProgrammeRepository $programme,SessionRepository $SessionRepository,EntityManagerInterface $entityManager)
    {
        $id=$session->getId();
        $stagiaire =  $stagiairesRepository->findOneBy(['id' => $idStagiaire]);
 //dd($stagiaire);
        $session->removeStagiaire($stagiaire);
        $stagiaire->removeSession($session);

        $entityManager->persist($session, $stagiaire);
        $entityManager->flush();


        $resultatProgramme=$programme->findBy(['session' => $session] );
        $stagiaires= $stagiairesRepository->findBy([], ["nom" => "Asc"]);
        $stagiaireNonInscrits= $SessionRepository->findByStagiairesNotInSession($id);
        
       return $this->render('session/show.html.twig', [
            'session'=> $session, 
            'programmes' => $resultatProgramme,
            'stagiaires' => $stagiaires ,
            'stagiaireNonInscrits' => $stagiaireNonInscrits
       ]);

    }
   
}
