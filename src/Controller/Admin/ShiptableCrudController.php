<?php

namespace App\Controller\Admin;

use App\Entity\Shiptable;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ShiptableCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shiptable::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('season'),
            AssociationField::new('team'),
            AssociationField::new('country'),
            Field::new('wins'),
            Field::new('nich'),
            Field::new('porazh'),
            Field::new('mz'),
            Field::new('mp'),
            Field::new('score'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('season')
            ->add('team')
            ->add('country')
        ;
    }
    
}
