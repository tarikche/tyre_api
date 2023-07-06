<?php

namespace App\Controller\Admin;

use App\Entity\Tyre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TyreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tyre::class;
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
