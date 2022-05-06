<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]
    public function index(): Response
    {
        return $this->render('Entreprise/done.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);
    }
    #[Route('/entreprise/add', name: 'add_entreprise')]
    public function index1(Request $request , ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pfe = $form->getData();
            $entityManager->persist($pfe);
            $entityManager->flush();
            $pfe = null;
            $this->addFlash('success', 'ajout avec succes');
            return $this->redirectToRoute('app_entreprise');
        } else {

            return $this->render('entreprise/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }


    }
}
