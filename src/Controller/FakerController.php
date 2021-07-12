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
            $article->setSouscategorie($SouscatRep->findID(37))
                    ->setImage("https://placehold.it/350x350")
                    ->setNom("Article n°$i")
                    ->setCouleur("red")
                    ->setDescription("la description")
                    ->setPrix("$i");
            $manager->persist($article);
        }
        #dump($article);
        $manager->flush();
        return $this->render('faker/index.html.twig', [
            'controller_name' => 'fakerController',
        ]);
    }
}
