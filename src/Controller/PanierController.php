<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Commande;
use App\Repository\PanierRepository;
use App\Repository\ArticleRepository;
use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */




    public function index(PanierRepository $PanierRepository): Response
    {
        $panier = $PanierRepository->findAll();
        #dump($panier);

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/panier/add/{slug}", name="panier_add")
     */

    public function add(string $slug,ArticleRepository $articleRep,ClientRepository $clientRep,CommandeRepository $commandeRep,PanierRepository $PanierRepository)
    {

        $manager= $this->getDoctrine()->getManager();    
        $article = new Panier;



        $user = $this->getUser();
        $client = $clientRep->findClientID($user);
        dump($user);
        dump($client);
        $panierCommande = $commandeRep->findCommande($client);
        if ($panierCommande == false) {    
            /*
            
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
            dump($panierCommande);
            dump($commande);
           */
        }
        else{
            $panierCommande = $commandeRep->findCommande($client);
            dump($panierCommande);
            $article->setArticle($articleRep->findArticleSlug($slug))
            ->setCommande($panierCommande)
            ->setQuantite(1);
    
            $manager->persist($article);
            $manager->flush();
        }

        
        


        /*
        $article->setArticle($articleRep->findArticleSlug($slug))
        ->setCommande($panierCommande)
        ->setQuantite(1);

        $manager->persist($article);
        $manager->flush();
       */
        
        return $this->redirectToRoute('panier');

    }

}
