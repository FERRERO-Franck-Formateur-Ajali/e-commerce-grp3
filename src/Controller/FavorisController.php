<?php

namespace App\Controller;

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
}