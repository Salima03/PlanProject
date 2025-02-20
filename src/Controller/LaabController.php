<?php

namespace App\Controller;
use App\Repository\ProjetRepository;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine;
use App\Repository\UtilisateursRepository;

class LaabController extends AbstractController
{
    // Route pour afficher la page d'accueil de l'utilisateur
    #[Route('/laab', name: 'app_laab')]
    public function index( ProjetRepository $projet): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        // Récupérer l'utilisateur par son ID
      
        $projet1=$projet->findAll();

        // Vérifier si l'utilisateur existe
       

        // Retourner une vue avec les informations de l'utilisateur
        return $this->render('laab/index.html.twig', [
            
            'projets'=>$projet1,

        ]);
    }
}
