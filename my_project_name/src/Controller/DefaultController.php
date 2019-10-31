<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\User;
use App\Services\GiftsService;

class DefaultController extends AbstractController
{

  
    /**
     * @Route("/default/{name}", name="default")
     */
    public function index($name,GiftsService $gifts, Request $request, SessionInterface $session)
    {
        
        //$users = ['Adam','Robert','John','Susan'];

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $session->set('name','session value');
    
       // $session->remove('name');
       $session->clear();

        if($session->has('name')){
            exit($session->get('name'));
        }

       

        $cookie = new Cookie(
            'my_cookie',    // Cookie name
            'cookie value',  // Cookie value,
            time() + (2 * 365 * 24 * 60 * 60 ) // Expires after 2 years 
        ); 
        
        $res = new Response();
        $res->headers->setCookie( $cookie );
        $res->send();

        $res = new Response();
        $res->headers->clearCookie('my_cookie');
        $res->send();

        $this->addFlash(

            'notice',
            'Your chances were saved!'

        );

        $this->addFlash(
            'warning',
            'Your chages warning were saved'

        );


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'name'            => $name,
            'users'           => $users,
            'random_gift'     => $gifts->gifts
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

     /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     */

     public function blog(){

        return new Response('Optional parameters in url and requirements for paramenters');

     }

     /**
     * @Route("/articles/{_locale}/{year}/{slug}/{category}",
     *  defaults = {"category": "computers"},
     *  requirements = {
     *   "locale" : "en|fr",
     *   "category": "computers|rtv",
     *   "year" : "\d+"
     * 
     * }
     *  )
     */

     public function articles(){
         return new Response('An adanced route example');
     }

     /**
     * @Route({
     * 
     *  "nl" : "/over-ons",
     *  "en" : "/about-us"
     *  
     *  },name="about_us")
     */

     public function lenguaje(){

            return new Response('Trnaslated routes');

     }
     

    
}
