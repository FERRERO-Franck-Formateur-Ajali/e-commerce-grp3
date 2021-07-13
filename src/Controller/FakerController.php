<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\SouscategorieRepository;
class FakerController extends AbstractController
{
    /**
     * @Route("/faker", name="faker")
     */
    public function load(SouscategorieRepository $SouscatRep) 
    {
        
         

        $manager= $this->getDoctrine()->getManager();        
        for($i=1; $i<=10; $i++){
            $article = new Article;
            $article->setSouscategorie($SouscatRep->findID(1))
                    ->setImage("https://placehold.it/350x350")
                    ->setNom("Article n°$i")
                    ->setCouleur("red")
                    ->setDescription("la description")
                    ->setPrix("$i");
            $manager->persist($article);
            $article2 = new Article;
            $article2->setSouscategorie($SouscatRep->findID(15))
                    ->setImage("https://placehold.it/350x350")
                    ->setNom("produit n°$i")
                    ->setCouleur("red")
                    ->setDescription("la description")
                    ->setPrix("$i");
            $manager->persist($article2);
        }
        #dump($article);
        $manager->flush();
        return $this->render('faker/index.html.twig', [
            'controller_name' => 'fakerController',
        ]);
    }
}
