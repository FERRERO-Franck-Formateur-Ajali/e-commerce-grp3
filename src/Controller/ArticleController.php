<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\ClientRepository;
use App\Repository\ArticleRepository;
use Container6WmGn4O\getUserTypeService;
use App\Repository\CommentaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{slug}", name="article")
     */
    public function index(Article $article, string $slug ,Request $request,ClientRepository $clientRep,ArticleRepository $articleRep,CommentaireRepository $comRep,PaginatorInterface $paginator): Response
    {

        $com = new Commentaire();
        
        $form = $this->createForm(CommentaireType::class, $com);
        
        $form->handleRequest($request);
        #dump($articleRep->findArticleCom($nom));
        #dump($clientRep->findClientID(1));
        $user = $this->getUser();
        $client = $clientRep->findClientID($user);
        $articleDetail = $articleRep->findArticleCom($slug);
        #dump($com);
        if($form->isSubmitted() && $form->isValid()){
            $com->setDateheure(new \DateTime('now', new \DateTimeZone('Europe/Paris')))
                ->setArticle($articleDetail)
                ->setClient($client);
                

            $manager= $this->getDoctrine()->getManager();
            $manager->persist($com);
            $manager->flush();
            #refresh la page 
            return $this->redirect($request->getUri());
        }

        $commentaire= $comRep->findCom($articleDetail);
        #dump($commentaire);

        $page = $paginator->paginate(
            $commentaire,
            $request->query->getInt('page',1),5
        );
        

        #dump($article);
        
        #dump($commentaire);
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'commentaire' => $commentaire,
            'formCom'=>$form->createView(),
            'page' => $page,
    
        ]);
    }
}
