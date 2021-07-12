<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Form\ArticleType;
use App\Repository\CategorieRepository;
use App\Repository\SouscategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    
    /**
     * @Route("/admin/new/article", name="admin_new_article")
     * @Route("/admin/new/article/{id}", name="admin_edit_article")
     */
    public function newArticle(Request $request, CategorieRepository $categorieRepo, ?Article $article): Response
    {
        $categorie = null;
        $manager = $this->getDoctrine()->getManager();
        $edition = $article === null ? 'new' : 'edit';
        $article = $article === null ? new Article() : $article;

        if($article->getSouscategorie() !== null){
            $categorie = $categorieRepo->findCategorieBySouscategorie($article->getSouscategorie());
        }

        $form = $this->createForm(ArticleType::class, $article, [
            'edition' => $edition,
            'categorie' => $categorie
        ]);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) { 
            $manager->persist($article);
            $manager->flush();

            $url = $this->adminUrlGenerator
                ->setController(ArticleCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl();

            return new RedirectResponse($url);
        }

        return $this->render('admin/article/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
    

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, ACTION::NEW , function(Action $action){
                return $action->setIcon('fa fa-plus-circle')->setLabel('Ajouter un article')->linkToRoute('admin_new_article');
            })
            ->update(Crud::PAGE_INDEX, ACTION::EDIT , function(Action $action){
                return $action->setIcon('fa fa-pencil')->setLabel('Modifier votre article')->linkToRoute('admin_edit_article',function(Article $article): array{
                    return [
                        'id' => $article->getId(),
                    ];
                });    
            });
         
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            'nom',
            'image',
            'prix',
            IntegerField::new('stock', 'Stock')
                ->formatValue(function ($value) {
                    return $value < 10 ? sprintf('%d  <strong>LOW STOCK</strong>', $value) : $value;
                 }),
            'couleur',
            'description',
            'promotion',
            'statut',
            AssociationField::new('souscategorie')
            // CollectionField::new('categorie'),
        ];
    }
}
