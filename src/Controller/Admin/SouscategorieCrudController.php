<?php

namespace App\Controller\Admin;

use App\Entity\Souscategorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SouscategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Souscategorie::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
