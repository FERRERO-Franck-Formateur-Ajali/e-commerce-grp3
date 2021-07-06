<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{nom}", name="article")
     */
    public function index(Article $article): Response
    {

        dump($article);
        $commentaire= $article->getCommentaires()->toArray();
        dump($commentaire);
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'commentaire' => $commentaire,
    
        ]);
    }
}
