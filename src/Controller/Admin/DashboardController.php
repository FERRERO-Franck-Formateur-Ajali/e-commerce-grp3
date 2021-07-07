<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Client;
use App\Entity\Categorie;
use App\Entity\Souscategorie;
use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zone Cash');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Client', 'fas fa-address-card', Client::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-clipboard-list', Categorie::class);
        yield MenuItem::linkToCrud('Marque', 'fas fa-clipboard-list', Souscategorie::class);
        yield MenuItem::linkToCrud('Article', 'fas fa-tags', Article::class);
        yield MenuItem::linkToCrud('Commande', 'fas fa-list', Commande::class);
        yield MenuItem::linkToCrud('Panier', 'fas fa-shopping-basket', Panier::class);
        yield MenuItem::linkToCrud('Commentaire', 'fas fa-comments', Commentaire::class);
        

    }
}
