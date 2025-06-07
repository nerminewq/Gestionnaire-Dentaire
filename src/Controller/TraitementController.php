<?php

namespace App\Controller;

use App\Entity\Traitement;
use App\Form\TraitementType;
use App\Repository\TraitementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/traitement")
 */
class TraitementController extends AbstractController
{
    /**
     * @Route("/", name="traitement_index", methods={"GET"})
     */
    public function index(TraitementRepository $traitementRepository): Response
    {
        return $this->render('traitement/index.html.twig', [
            'traitements' => $traitementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="traitement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $traitement = new Traitement();
        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traitement);
            $entityManager->flush();

            $this->addFlash('success', 'Traitement créé avec succès.');
            return $this->redirectToRoute('traitement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement/new.html.twig', [
            'traitement' => $traitement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traitement_show", methods={"GET"})
     */
    public function show(Traitement $traitement): Response
    {
        return $this->render('traitement/show.html.twig', [
            'traitement' => $traitement,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="traitement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Traitement $traitement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Traitement modifié avec succès.');
            return $this->redirectToRoute('traitement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement/edit.html.twig', [
            'traitement' => $traitement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traitement_delete", methods={"POST"})
     */
    public function delete(Request $request, Traitement $traitement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traitement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($traitement);
            $entityManager->flush();
            $this->addFlash('success', 'Traitement supprimé avec succès.');
        }

        return $this->redirectToRoute('traitement_index', [], Response::HTTP_SEE_OTHER);
    }
}
