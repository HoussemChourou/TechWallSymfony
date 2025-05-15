<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
            ['personnes' => $personnes,]);
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
    public function indexAlls(ManagerRegistry $doctrine,$page,$nbre):Response{
        $repository = $doctrine->getRepository(Personne::class);
        $personnes = $repository->findBy([], [] ,$nbre,($page-1)*$nbre);

        $nbPersonne=$repository->count([]);

        $nbPages = ceil($nbPersonne/$nbre);

        return $this->render('personne/index.html.twig',
            ['personnes' => $personnes,
                'isPaginated'=>true,
                'nbPages'=>$nbPages,
                'page'=>$page,
                'nbre'=>$nbre,
                ]);
    }




    #[Route('/delete/{id<\d+>}', name: 'personne.delete')]
    public function deletePersonne(ManagerRegistry $doctrine,Personne $personne=null): RedirectResponse
    {
        //recuperer la personne
        if($personne){
            //si la personne existe => supprimer la personne avec un flashMessage
            $entityManager = $doctrine->getManager();
            $entityManager->remove($personne);
            $entityManager->flush();
            $this->addFlash('sucess',"Personne supprimée avec succès !");
            return $this->redirectToRoute('personne.list.alls');
        }
        //sinon retourner un flashMessage d erreur
        $this->addFlash('error',"Personne n'est pas trouvée !");
        return $this->redirectToRoute('personne.list.alls');
    }

    #[Route('/update/{id}/{name}/{firstname}/{age}', name: 'personne.update')]
    public function updatePersonne(ManagerRegistry $doctrine,Personne $personne=null,$name,$firstname,$age): RedirectResponse{
        if($personne){
            $personne->setFirstname($firstname);
            $personne->setName($name);
            $personne->setAge($age);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();
            $this->addFlash('success',"Personne modifiée avec succès !");
            return $this->redirectToRoute('personne.list.alls');
        }
        $this->addFlash('error',"Personne n'est pas trouvée !");
        return $this->redirectToRoute('personne.list.alls');
    }

    #[Route('/alls/age/{ageMin}/{ageMax}', name: 'personne.age')]
    public function personneByAge(ManagerRegistry $doctrine,$ageMin,$ageMax,$page=1,$nbre=12): Response{
        $repository = $doctrine->getRepository(Personne::class);
        $personnes = $repository->findPersonneByAgeInterval($ageMin,$ageMax);
        return $this->render('personne/index.html.twig',
            ['personnes' => $personnes,
                'isPaginated'=>true,
                'nbPages'=>ceil(count($personnes)/$nbre),
                'page'=>$page,
                'nbre'=>$nbre,]);
    }

    #[Route('/stats/age/{ageMin}/{ageMax}', name: 'personne.stats.age')]
    public function statsPersonneByAge(ManagerRegistry $doctrine,$ageMin,$ageMax): Response{
        $repository = $doctrine->getRepository(Personne::class);
        $stats = $repository->statsPersonneByAgeInterval($ageMin,$ageMax);
        return $this->render('personne/stats.html.twig',
            ['stats'=>$stats[0],
                'ageMin'=>$ageMin,
                'ageMax'=>$ageMax,
                ]);
    }
}
