<?php
// src/Controller/PlanprojetController.php
// src/Controller/PlanprojetController.php

namespace App\Controller;

use App\Entity\Fichier;
use App\Entity\Projet;
use App\Entity\Plan;
use App\Form\PlanType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanprojetController extends AbstractController
{
    #[Route('/projet/{id}/plans', name: 'projet_plans')]

    public function afficherPlans(Projet $projet, Request $request, EntityManagerInterface $em): Response
    {
        $plans = $projet->getPlans();
        $plan = new Plan();
        $plan->setNumero1($projet);

        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $files = $form->get('fichiers')->getData();

            if ($files) {
                foreach ($files as $file) {
                    // Gérer uniquement les fichiers valides
                    if ($file instanceof UploadedFile) {
                        $extension = $file->guessExtension() ?? 'bin'; // Définit une extension par défaut si aucune n'est devinée
                        $filename = uniqid() . '.' . $extension;                        
                        $file->move($this->getParameter('uploads_directory'), $filename);
                        $fichier = new Fichier();
                        $fichier->setNomFichier($filename);
                        $fichier->setPlan($plan);

                        $plan->addFichier($fichier);  
                    }
                }
            }

            $em->persist($plan);
            $em->flush();

            return $this->redirectToRoute('projet_plans', ['id' => $projet->getId()]);
        }

        return $this->render('planprojet/index.html.twig', [
            'projet' => $projet,
            'plans' => $plans,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/projet/{projetId}/plans/supprimer/{planId}', name: 'supprimer_plan', methods: ['POST'])]
    public function supprimerPlan(int $projetId, int $planId, EntityManagerInterface $em): Response
    {
        // Trouver le plan à supprimer
        $plan = $em->getRepository(Plan::class)->find($planId);

        if ($plan) {
            // Supprimer les fichiers associés au plan, si nécessaire
            foreach ($plan->getFichiers() as $fichier) {
                // Supprimer les fichiers de l'upload (facultatif, selon ta logique)
                $fichierPath = $this->getParameter('uploads_directory') . '/' . $fichier->getNomFichier();
                if (file_exists($fichierPath)) {
                    unlink($fichierPath);  // Supprimer le fichier physique
                }
                $em->remove($fichier);  // Supprimer l'entité Fichier
            }

            // Supprimer le plan
            $em->remove($plan);
            $em->flush();


            return $this->redirectToRoute('projet_plans', ['id' => $projetId]);
        }


        return $this->redirectToRoute('projet_plans', ['id' => $projetId]);
    }

}
