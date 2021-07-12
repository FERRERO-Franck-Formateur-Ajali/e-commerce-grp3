<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
