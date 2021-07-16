<?php

namespace App\Controller;

use App\Entity\Favoris;
use App\Repository\ClientRepository;
use App\Repository\ArticleRepository;
use App\Repository\FavorisRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavorisController extends AbstractController
{
    /**
     * @Route("/favoris", name="favoris")
     */
    public function index(FavorisRepository $FavorisRepository): Response
    {
        $favoris = $FavorisRepository->findAll();

        return $this->render('favoris/index.html.twig', [
            'controller_name' => 'FavorisController',
            'favoris' => $favoris,
        ]);
    }

 /**
     * @Route("/favoris/add/{slug}", name="favoris_add")
     */

    public function add(string $slug,ArticleRepository $articleRep,ClientRepository $clientRep,FavorisRepository $FavorisRepository)
    {   
        return $this->redirectToRoute('favoris');
    }

}