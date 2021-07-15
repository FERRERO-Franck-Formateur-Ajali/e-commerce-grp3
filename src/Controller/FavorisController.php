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

 /**
     * @Route("/favoris/add/{slug}", name="favoris_add")
     */

    public function add(string $slug,ArticleRepository $articleRep,ClientRepository $clientRep,FavorisRepository $FavorisRepository)
    {

        $manager= $this->getDoctrine()->getManager();    
        $article = new Favoris;

        $user = $this->getUser();
        $client = $clientRep->findClientID($user);
        if ($panierCommande == false) {    
            
            
            $commande->setClient($client)
                     ->setDateheure(new \DateTime('now', new \DateTimeZone('Europe/Paris')))
                     ->setNumeroCommande('a')
                     ->setStatut(false);
            $manager->persist($commande);
            $manager->flush();
            

            $article->setArticle($articleRep->findArticleSlug($slug))
            ->setCommande($commande)
            ->setQuantite(1);
    
            $manager->persist($article);
            $manager->flush();
           
        }
        else{
            $panierCommande = $commandeRep->findCommande($client);
            $article->setArticle($articleRep->findArticleSlug($slug))
            ->setCommande($panierCommande)
            ->setQuantite(1);
    
            $manager->persist($article);
            $manager->flush();
        }
        
        return $this->redirectToRoute('panier');

    }

}