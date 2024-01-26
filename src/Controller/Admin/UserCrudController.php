<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('email')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            ArrayField::new('roles'),
            TextField::new('nom')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('prenom')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('numTel')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('numVoie')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('voie')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('codePostal')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            TextField::new('ville')
            ->setFormTypeOptions([
                'disabled' => true,
            ]),
            DateTimeField::new('createdAt')
                ->setFormTypeOptions([
                    'disabled' => true,
                ]),
        ];
    }
    
}