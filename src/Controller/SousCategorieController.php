<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Souscategorie;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SousCategorieController extends AbstractController
{
    /**
     * @Route("/categorie/{cate}/{nom}", name="sous_categorie")
     */
    public function index(ArticleRepository $ArticleRepository, string $cate = null, string $nom = null): Response
    {
        $cat = $sub = null;
        if($cate !== null && $nom !== null ){
            $art= $ArticleRepository->findArticle($nom,$cate);
            dump($art);
            $cat = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
            $sub = $this->getDoctrine()->getRepository(Souscategorie::class)->findAll();
        }


        

        return $this->render('sous_categorie/index.html.twig', [
            'controller_name' => 'SousCategorieController',
            'categories' => $cat,
            'souscategories' => $sub,
            'article' => $art,
            'nom' =>$nom,
            'cat' =>$cate,
        ]);
    }
}
