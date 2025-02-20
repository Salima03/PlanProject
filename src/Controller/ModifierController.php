<?php

// src/Controller/ProjetController.php
namespace App\Controller;

use App\Entity\Projet;
use App\Form\ModifierProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifierController extends AbstractController
{
    #[Route('/projet/{id}/edit', name: 'edit_projet')]
    public function edit(
        Projet $projet,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // Créer le formulaire avec les données existantes
        $form = $this->createForm(ModifierProjetType::class, $projet);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder les modifications
            $entityManager->flush();


            // Rediriger vers une autre page, comme la liste des projets
            return $this->redirectToRoute('app_laab');
        }

        // Afficher le formulaire
        return $this->render('modifier/index.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet,
        ]);
    }
}
