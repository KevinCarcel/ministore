<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrdersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('reference'),
            TextEditorField::new('deliveryAdress'),
            DateTimeField::new('createdAt')
                ->setFormTypeOptions([
                    'disabled' => true,
                ]),
                AssociationField::new('user')
                ->formatValue(function ($value, $entity) {
                    return $value->getPrenom() . ' ' . $value->getNom();
                }), 
        ];
    }
    
}