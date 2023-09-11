<?php

namespace App\Controller\Admin;

use App\Entity\OrderLine;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderLineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderLine::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('quantity'),
            AssociationField::new('OrderId')    
            ->formatValue(function ($value, $entity) {
                return $value;
            }),
            AssociationField::new('tyre')
            ->formatValue(function ($value, $entity) {
                return $value;
            }),
        ];
    }
    
}
