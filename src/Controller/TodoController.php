<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route("/todo")]
final class TodoController extends AbstractController
{
    #[Route('/', name: 'todo')]
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
    #[Route(
        '/add/{name}/{content?no input}',
        name:'todo.add',
        )]
    public function addTodo(Request $request, $name, $content):RedirectResponse{
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

    #[Route('/update/{name}/{content}',name:'todo.update')]
    public function updateTodo(Request $request, $name, $content):RedirectResponse{
        $session=$request->getSession();
        if($session->has('todo')){
            $todo=$session->get('todo');
            if(!isset($todo[$name])){
                $this->addFlash('error',"LE todo d'id $name n existe pas dans la liste");
            }
            else{
                $todo[$name]=$content;
                $this->addFlash('success',"LE todo d'id $name a ete modifie avec succes !");
                $session->set('todo',$todo);
            }
        }
        else{
            $this->addFlash('error','La liste es todos n est pas encore initialisee');

        }
        return($this->redirectToRoute('todo'));
    }

    #[Route('/delete/{name}',name:'todo.delete')]
    public function deleteTodo(Request $request, $name):RedirectResponse{
        $session=$request->getSession();
        if($session->has('todo')){
            $todo=$session->get('todo');
            if(!isset($todo[$name])){
                $this->addFlash('error',"LE todo d'id $name n existe pas dans la liste");
            }
            else{
                unset($todo[$name]);
                $this->addFlash('success',"LE todo d'id $name a ete supprime avec succes !");
                $session->set('todo',$todo);
            }
        }
        else{
            $this->addFlash('error','La liste es todos n est pas encore initialisee');

        }
        return($this->redirectToRoute('todo'));
    }

    #[Route('/reset',name:'todo.reset')]
    public function resetTodo(Request $request):RedirectResponse{
        $session=$request->getSession();
        $session->remove('todo');
        return($this->redirectToRoute('todo'));
    }


//    #[Route('/multi/{entier1<\d+>}/{entier2<\d+>}',
//        name:"multi"
//    )]
//    public function multiplication(Request $request,$entier1, $entier2){
//        $result=$entier1*$entier2;
//        return new Response("<h1>$result</h1>");
//    }

}
