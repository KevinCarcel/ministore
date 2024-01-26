<?php

namespace App\Controller\Admin;

use App\Entity\Nav;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class NavCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nav::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            UrlField::new('lien'),
        ];
    }
    
}