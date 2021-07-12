<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\ClientRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{nom}", name="article")
     */
    public function index(Article $article, string $nom ,Request $request,ClientRepository $clientRep,ArticleRepository $articleRep): Response
    {

        $com = new Commentaire();

        $form = $this->createForm(CommentaireType::class, $com);
        
        $form->handleRequest($request);
        #dump($articleRep->findArticleCom($nom));
        #dump($clientRep->findClientID(1));
        
        if($form->isSubmitted() && $form->isValid()){
            $com->setDateheure(new \DateTime('now', new \DateTimeZone('Europe/Paris')))
                ->setArticle($articleRep->findArticleCom($nom))
                ->setClient($clientRep->findClientID(2));
                

            $manager= $this->getDoctrine()->getManager();
            $manager->persist($com);
            $manager->flush();
        }
        

        #dump($article);
        $commentaire= $article->getCommentaires()->toArray();
        #dump($commentaire);
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'commentaire' => $commentaire,
            'formCom'=>$form->createView(),
    
        ]);
    }
}
