<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/patient")
 */
class PatientController extends AbstractController
{
     /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }
    /**
 * @Route("/nouveau", name="patient_new", methods={"GET", "POST"})
 */
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $patient = new Patient();
    $form = $this->createForm(PatientType::class, $patient);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($patient);
        $entityManager->flush();

        $this->addFlash('success', 'Patient créé avec succès.');
        return $this->redirectToRoute('patient_index', [], Response::HTTP_SEE_OTHER);
    }

return $this->render('patient/new.html.twig', [
    'patient' => $patient,
    'form' => $form->createView(),
]);

}

  /**
     * @Route("/{id}", name="patient_show", methods={"GET"})
     */
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

      /**
     * @Route("/{id}/modifier", name="patient_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Patient $patient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Patient modifié avec succès.');
            return $this->redirectToRoute('patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/{id}", name="patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Patient $patient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager->remove($patient);
            $entityManager->flush();
            $this->addFlash('success', 'Patient supprimé avec succès.');
        }

        return $this->redirectToRoute('patient_index', [], Response::HTTP_SEE_OTHER);
    }
}
