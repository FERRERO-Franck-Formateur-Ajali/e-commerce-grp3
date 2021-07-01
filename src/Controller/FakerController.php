<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Souscategorie;
use App\Repository\SouscategorieRepository;

use Doctrine\Persistence\ObjectManager;

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
                    ->setCouleur("black")
                    ->setDescription("la description ")
                    ->setPrix("$i");
            $manager->persist($article);
        }
        dump($article);
        $manager->flush();
        return $this->render('faker/index.html.twig', [
            'controller_name' => 'fakerController',
        ]);
    }
}
