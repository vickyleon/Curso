<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default/{name}", name="default")
     */
    public function index($name)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'name'            => $name,
        ]);
    }
    /**
     * @Route("/default1/{name}", name="default1")
     */
    public function index1($name){

        return $this->redirectToRoute('default2');

    }
    /**
     * @Route("/default2/", name="default2")
     */
    public function index2(){
        return new Response('I am from default 2 ');
    }


    
}
