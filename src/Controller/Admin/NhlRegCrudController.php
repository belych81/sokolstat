<?php

namespace App\Controller\Admin;

use App\Entity\NhlReg;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NhlRegCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NhlReg::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('season'),
            AssociationField::new('team'),
            AssociationField::new('player'),
            Field::new('goal'),
            Field::new('assist'),
            Field::new('score'),
            Field::new('goalSum'),
            Field::new('assistSum'),
            Field::new('scoreSum'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('season')
            ->add('team')
        ;
    }
    
}
