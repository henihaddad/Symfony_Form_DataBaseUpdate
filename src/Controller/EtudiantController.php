<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Form\EntrepriseType;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }
    #[Route('/etudiant/add', name: 'add_etudiant')]
    public function index2(Request $request , ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData();
            $entityManager->persist($etudiant);
            $entityManager->flush();
            $etudiant = null;
            $this->addFlash('success', 'ajout avec succes');
            return $this->redirectToRoute('app_entreprise');
        } else {

            return $this->render('etudiant/form.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }
    #[Route('/etudiant/list', name: 'list_etudiant')]
    public function index3(Request $request , ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = new Etudiant();
        getContainer()->get('doctrine.dbal.default_connection')->getSchemaManager()->listTableNames();

    }
}
