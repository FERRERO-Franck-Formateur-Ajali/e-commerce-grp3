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
    public function index(FavorisRepository $favorisRep,ClientRepository $clientRep): Response
    {
        /*
        $user = $this->getUser();
        $client = $clientRep->findClientID($user); 
        $article = $favorisRep->findFavoris($client);
        */
        return $this->render('favoris/index.html.twig', [
            'controller_name' => 'FavorisController',
            #'favoris' => $article,
        ]);
    }

    /**
     * @Route("/favoris/add/{slug}", name="favoris_add")
     */
    public function add(string $slug,ArticleRepository $articleRep,ClientRepository $clientRep)
    {

        $manager= $this->getDoctrine()->getManager();    
        
        // Cherche client 
        $user = $this->getUser();
        $client = $clientRep->findClientID($user); 
        //Article en cours 
        $articleDetail = $articleRep->findArticleSlug($slug);


        $favoris = new Favoris;
        $favoris->setClient($client)
                    ->setArticle($articleDetail);
        $manager->persist($favoris);
        $manager->flush();   
             
        return $this->redirectToRoute('favoris');

    }
}
