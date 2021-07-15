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
use Symfony\Component\Validator\Constraints\Length;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     * 
     */

    public function index(PanierRepository $panierRepository,ClientRepository $clientRep,CommandeRepository $commandeRep): Response
    {   

        $user = $this->getUser();
        $client = $clientRep->findClientID($user);
        $panierCommande = $commandeRep->findCommande($client);
        // cherche le panier en fonction de la commande
        $article= $panierRepository->findPanierArticle($panierCommande);

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'panier' => $article,
            

        ]);
    }

    /**
     * @Route("/panier/add/{slug}", name="panier_add")
     */

    public function add(string $slug,ArticleRepository $articleRep,ClientRepository $clientRep,CommandeRepository $commandeRep,PanierRepository $panierRepository)
    {

        $manager= $this->getDoctrine()->getManager();    
        $article = new Panier;
        
        // Cherche client 
        $user = $this->getUser();
        $client = $clientRep->findClientID($user);


        //Article en cours 
        $articleDetail = $articleRep->findArticleSlug($slug);

        // cherche la commande --- Commande null
        $panierCommande = $commandeRep->findCommande($client);
        //dump($panierCommande);
        
        // Si aucune commande existe 
        if ($panierCommande == false) {  
             // cree la commande           
            $commande = new Commande;
            $commande->setClient($client)
                     ->setDateheure(new \DateTime('now', new \DateTimeZone('Europe/Paris')))
                     ->setNumeroCommande('a')
                     ->setStatut(false);
            $manager->persist($commande);
            $manager->flush();

            // Puis crée l'article en fonction de la commande 
        
            $article->setArticle($articleDetail)
                    ->setCommande($commande)
                    ->setQuantite(1);
            $manager->persist($article);
            $manager->flush();

            // Cherche le panier-> commande 
            $article= $panierRepository->findPanierArticle($commande);
            //dump($article);
           
        }
        else{
            // cherche la commande 
            $panierCommande = $commandeRep->findCommande($client);
            // cherche le panier en fonction de la commande
            $articles= $panierRepository->findPanierArticle($panierCommande);

            

            
     
            // cherche l'article a vérifier 
            $verif = $panierRepository->findPanierArt($articleDetail);

            // pour les article trouver dans le panier  :
            foreach ($articles as $key => $art) {
                    
                
                
                
                if($verif == $art){
                    $quantite = $art->getQuantite();                   
                    $quantite= $quantite+1;                 

                    $art->setArticle($articleDetail)
                        ->setCommande($panierCommande)
                        ->setQuantite($quantite);
                    $manager->persist($art);
                    $manager->flush();                    
                                  
                    
                }
                elseif( $verif == false ){
                                 
                    $article->setArticle($articleDetail)
                            ->setCommande($panierCommande)
                            ->setQuantite(1);
                    $manager->persist($article);
                    $manager->flush();
                    

                    
                }

                
                
                
                
            }



        }


        $article= $panierRepository->findPanierArticle($panierCommande);

    
        
        return $this->redirectToRoute('panier');


    }


        /**
     * @Route("/panier/moin/{slug}", name="panier_del")
     */

    public function moin(string $slug,ArticleRepository $articleRep,ClientRepository $clientRep,CommandeRepository $commandeRep,PanierRepository $panierRepository)
    {

        $manager= $this->getDoctrine()->getManager();    
        $article = new Panier;
        
        // Cherche client 
        $user = $this->getUser();
        $client = $clientRep->findClientID($user);


        //Article en cours 
        $articleDetail = $articleRep->findArticleSlug($slug);

        // cherche la commande --- Commande null
        $panierCommande = $commandeRep->findCommande($client);
        //dump($panierCommande);
        
        // Si aucune commande existe 

        if ($panierCommande == true) {
            // cherche la commande 
            $panierCommande = $commandeRep->findCommande($client);
            // cherche le panier en fonction de la commande
            $articles= $panierRepository->findPanierArticle($panierCommande);

            // cherche l'article a vérifier 
            $verif = $panierRepository->findPanierArt($articleDetail);

            // pour les article trouver dans le panier  :
            foreach ($articles as $key => $art) {
                    
                
                
                
                if($verif == $art){
                    $quantite = $art->getQuantite();
                    if($quantite >1){
                        $quantite= $quantite-1;
                    }                 
                                     

                    $art->setArticle($articleDetail)
                        ->setCommande($panierCommande)
                        ->setQuantite($quantite);
                    $manager->persist($art);
                    $manager->flush();                    
                                  
                    
                }
                elseif( $verif == false ){
                                 
                    $article->setArticle($articleDetail)
                            ->setCommande($panierCommande)
                            ->setQuantite(1);
                    $manager->persist($article);
                    $manager->flush();
                }
            }
        }

        $article= $panierRepository->findPanierArticle($panierCommande);

        return $this->redirectToRoute('panier');

    }

}


