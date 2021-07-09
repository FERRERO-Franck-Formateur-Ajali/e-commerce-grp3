<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SousCategorieController extends AbstractController
{
    /**
     * @Route("/categorie/{cate}/{nom}", name="sous_categorie")
     */
    public function index(ArticleRepository $ArticleRepository, string $cate = null, string $nom = null,Request $request, PaginatorInterface $paginator): Response
    {
        if($cate !== null && $nom !== null ){
            $art= $ArticleRepository->findArticle($nom,$cate);
            #dump($art);
        }

        $article = $paginator->paginate(
            $art,
            $request->query->getInt('page',1),
            6
        );

        
        return $this->render('sous_categorie/index.html.twig', [
            'controller_name' => 'SousCategorieController',
            'article' => $article,
            'nom' =>$nom,
            'cat' =>$cate,
        ]);
    }
}
