<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/personne')]
final class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine): Response{
        $entityManager = $doctrine->getRepository(Personne::class);
        $personnes = $entityManager->findAll();
        return $this->render('personne/index.html.twig',
            ['personnes' => $personnes]);
    }

    #[Route('/{id<\d+>}', name: 'personne.detail')]
    public function detail(ManagerRegistry $doctrine,Personne $personne = null): Response{
        if($personne){
            return $this->render('personne/detail.html.twig',
                ['personne' => $personne]);
        }
        else{
            $this->addFlash('error',"Personne n'existe pas");
            return $this->redirectToRoute('personne.list');
        }

    }

    #[Route('/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $personne = new Personne();
        $personne->setFirstname('Houssem');
        $personne->setName('Chourou');
        $personne->setAge(21);


        $entityManager->persist($personne);
        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }

    #[Route('/alls/{page?1}/{nbre?12}', name: 'personne.list.alls')]
    public function indexAlls(ManagerRegistry $doctrine,$page,$nbre): Response{
        $entityManager = $doctrine->getRepository(Personne::class);
        $personnes = $entityManager->findBy([], [] ,$nbre,($page-1)*$nbre);
        return $this->render('personne/index.html.twig',
            ['personnes' => $personnes]);
    }
}
