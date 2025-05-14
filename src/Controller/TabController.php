<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TabController extends AbstractController
{
    #[Route('/tab/notes/{nb}', name: 'app_tab')]
    public function index(Request $request,$nb): Response
    {
        $notes=[];
        for ($i=1; $i<=$nb; $i++) {
            $notes[]=rand(0,20);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    #[Route('/tab/users', name: 'tab.users')]
    public function users(): Response{
        $users=[
            ['firstname'=>'houssem','name'=>'chourou','age'=>21],
            ['firstname'=>'adam','name'=>'chourou','age'=>20],
            ['firstname'=>'ahmed','name'=>'chourou','age'=>22]
        ];

        return $this->render('tab/users.html.twig',[
            'users' => $users
        ]);
    }
}
