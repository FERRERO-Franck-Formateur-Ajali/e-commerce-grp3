<?php

namespace App\Twig;

use App\Repository\CategorieRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CategorieMenuExtension extends AbstractExtension
{
    private $categorie;

    public function __construct(CategorieRepository $categorie)
    {
        $this->categorie= $categorie;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('categories', [$this, 'categories']),
        ];
    }

    public function categories()
    {
        return $this->categorie->findAll();        
    }
    

}

