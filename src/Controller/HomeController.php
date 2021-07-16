<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Souscategorie;
use Container6WmGn4O\getUserTypeService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

            
        $art = $this->getDoctrine()->getRepository(Article::class)->findAll();
        
        $article = $paginator->paginate(
            $art,
            $request->query->getInt('page',1),
            12
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',      
            'article' => $art,
            'page' => $article,
        ]);
    }


}
