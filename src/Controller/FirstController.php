<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FirstController extends AbstractController
{
    #[Route('/template', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/first.html.twig',[
            'firstname'=>'Houssem',
            'name'=>'Chourou'
        ]);
    }

//    #[Route('/sayyHello/{name}/{firstname}', name: 'say_hello')]
    public function sayHello(Request $request,$name,$firstname): Response
    {
        return $this->render('first/index.html.twig',[
            'nom'=>$name,
            'prenom'=>$firstname
        ]);
    }
}
