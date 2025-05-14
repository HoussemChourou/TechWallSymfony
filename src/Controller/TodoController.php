<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        //Afficher notre tableau de todo
        $session=$request->getSession();
        if(!$session->has('todo')){
            $todo=[
                'achat'=>'achetr cle usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'Corriger mon correction'
            ];
            $session->set('todo',$todo);
            $this->addFlash('info','La liste des todos vient d etre initialisee');
        }
        return $this->render('todo/index.html.twig');
    }
    #[Route('/todo/add/{name}/{content}',name:'todo.add')]
    public function addTodo(Request $request, $name, $content){
        $session=$request->getSession();
        if($session->has('todo')){
            $todo=$session->get('todo');
            if(isset($todo[$name])){
                $this->addFlash('error',"LE todo d'id $name existe deja dans la liste");
            }
            else{
                $todo[$name]=$content;
                $this->addFlash('success',"LE todo d'id $name a ete ajoute avec succes !");
                $session->set('todo',$todo);
            }
        }
        else{
            $this->addFlash('error','La liste es todos n est pas encore initialisee');

        }
        return($this->redirectToRoute('todo'));
    }
}
