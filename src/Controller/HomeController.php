<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Souscategorie;
use App\Repository\SouscategorieRepository;
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
        #dump($nom);
        dump($sub);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $nom,
            'souscategories' => $sub,
        ]);
    }


}
