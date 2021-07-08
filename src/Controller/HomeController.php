<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Souscategorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        
        $art = $this->getDoctrine()->getRepository(Article::class)->findAll();

        #dump($nom);
        #dump($art);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',      
            'article' => $art,
        ]);
    }


}
