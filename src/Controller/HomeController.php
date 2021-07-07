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

        $nom = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $sub = $this->getDoctrine()->getRepository(Souscategorie::class)->findAll();
        $art = $this->getDoctrine()->getRepository(Article::class)->findAll();

        #dump($nom);
        #dump($sub);
        dump($art);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $nom,
            'souscategories' => $sub,
            'article' => $art,
        ]);
    }


}
