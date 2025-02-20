<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository; 
use App\Repository\FichierRepository; // Si vous avez un repository pour la table fichier
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    #[Route('/projet/delete/{id}', name: 'delete_projet', methods: ['POST'])]
    public function deleteProjet(int $id, ProjetRepository $repository, FichierRepository $fichierRepository, EntityManagerInterface $em): Response
    {
        // Trouver le projet à supprimer
        $projet = $repository->find($id);
        // Vérifiez si le projet existe
        if (!$projet) {
            $this->addFlash('error', 'Projet introuvable.');
            return $this->redirectToRoute('app_laab');
        }
        // Vérifiez si le projet contient des plans
        if (!$projet->getPlans()->isEmpty()) {
            $this->addFlash('error', 'This project contains plans. Please delete them before deleting the project.');
            return $this->redirectToRoute('app_laab');
        }

        
        if ($projet) {
            // Supprimer les fichiers associés au projet
            $fichiers = $fichierRepository->findBy(['plan' => $projet]);
            foreach ($fichiers as $fichier) {
                $em->remove($fichier); // Supprimer chaque fichier associé
            }
            
            // Maintenant supprimer le projet
            $em->remove($projet);
            $em->flush(); // Appliquer les changements à la base de données

            // Ajouter un message de succès
        } 

        // Rediriger après suppression
        return $this->redirectToRoute('app_laab');
    }
}
