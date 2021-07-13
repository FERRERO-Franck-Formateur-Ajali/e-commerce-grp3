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
        
         
        // changer la sous cateorie en fonction de votre DB
        $manager= $this->getDoctrine()->getManager();        
        for($i=1; $i<=5; $i++){
            $lenovo = new Article;
            $lenovo->setSouscategorie($SouscatRep->findID(1))
                    ->setImage("lenovo1.jpg")
                    ->setNom("lenovo Modele $i")
                    ->setCouleur("gray")
                    ->setDescription("Un pc portable lenovo")
                    ->setPrix(100*$i)
                    ->setStock(25*$i);
            $msi = new Article;
            $msi->setSouscategorie($SouscatRep->findID(1))
                    ->setImage("msi1.jpg")
                    ->setNom("MSI Modele $i")
                    ->setCouleur("red")
                    ->setDescription("Un pc portable msi next generation")
                    ->setPrix(200*$i)
                    ->setStock(10*$i);
            $huawei = new Article;
            $huawei->setSouscategorie($SouscatRep->findID(2))
                    ->setImage("huawei.jpg")
                    ->setNom("huawei Modele $i")
                    ->setCouleur("blue")
                    ->setDescription("Un smartphone chinois pas cher")
                    ->setPrix(75*$i)
                    ->setStock(125*$i);
            $apple = new Article;
            $apple->setSouscategorie($SouscatRep->findID(2))
                    ->setImage("Applephone1.jpg")
                    ->setNom("apple Modele $i")
                    ->setCouleur("gold")
                    ->setDescription("Un smartphone vraiment cher pour pas grnad chose")
                    ->setPrix(300*$i)
                    ->setStock(5*$i);
            $manager->persist($lenovo);
            $manager->persist($msi);
            $manager->persist($huawei);
            $manager->persist($apple);
        }
        #dump($article);
        $manager->flush();
        return $this->render('faker/index.html.twig', [
            'controller_name' => 'fakerController',
        ]);
    }
}
