<?php

namespace App\Controller\Admin;

use App\Entity\Team;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Team::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('translit'),
            AssociationField::new('country'),
            TextField::new('image'),
            TextField::new('image2'),
            IdField::new('game')->onlyOnForms(),
            IdField::new('wins')->onlyOnForms(),
            IdField::new('nich')->onlyOnForms(),
            IdField::new('porazh')->onlyOnForms(),
            IdField::new('mz')->onlyOnForms(),
            IdField::new('mp')->onlyOnForms(),
            IdField::new('score')->onlyOnForms(),
            AssociationField::new('city'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('city')
            ->add('country')
        ;
    }
    
}
