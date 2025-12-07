<?php

namespace App\Controller;


use App\Entity\Voiture;
use App\Form\VoitureForm;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function index(): Response
    {
        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'VoitureController',
        ]);
    }

    #[Route('/voitures', name: 'Voiture_liste')]
    public function listeVoiture(VoitureRepository$vr):Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/listeVoiture.html.twig', [
            'listeVoiture' => $voitures
        ]);
    }
    #[Route('/addVoiture', name: 'add_voiture')]
    public function addVoiture(Request $request, EntityManagerInterface $em)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureForm::class, $voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('Voiture_liste');
        }

        return $this->render('voiture/addVoiture.html.twig', [
            'formV' => $form->createView()
        ]);
    }
    #[Route('/voiture/{id}/delete', name: 'voitureDelete')]
    public function delete(EntityManagerInterface $em, VoitureRepository $vr, $id): Response
    {
        // 1. Récupérer l’entité avec l’id spécifié (
        $voiture = $vr->find($id);

        // Vérification de l'existence de la voiture
        if (!$voiture) {
            throw $this->createNotFoundException('Voiture non trouvée pour l\'ID '.$id);
        }

        // 2. Supprimer l’entité récupérée et valider (Page 16)
        $em->remove($voiture);
        $em->flush();

        // 3. Rediriger la page vers la liste des voitures (Page 16)
        return $this->redirectToRoute('Voiture_liste');
    }
    #[Route('/voiture/{id}/update', name: 'voitureUpdate')]
    public function updateVoiture(Request $request, EntityManagerInterface $em, VoitureRepository $vr, $id): Response
    {
        // Charger l’instance qui correspond à l’ID en paramètre
        $voiture = $vr->find($id);

        // Vérifier si l'entité existe
        if (!$voiture) {
            throw $this->createNotFoundException('Voiture non trouvée pour l\'ID '.$id);
        }

        // Utiliser $form pour le formulaire (ou $editform, peu importe le nom interne)
        $form = $this->createForm(VoitureForm::class, $voiture); // Renommé $editform en $form pour simplifier
        $form->handleRequest($request);

        // Vérification de la soumission et de la validité
        if ($form->isSubmitted() && $form->isValid()) {

            // persist() et flush() pour enregistrer les modifications
            $em->persist($voiture);
            $em->flush();

            // Rediriger vers la liste des voitures
            return $this->redirectToRoute('Voiture_liste');
        }

        // 💡 CORRECTION : Utiliser une clé simple comme 'formV' sans espace
        return $this->render('voiture/voitureUpdate.html.twig', [
            'formV' => $form->createView()
        ]);
    }
}
