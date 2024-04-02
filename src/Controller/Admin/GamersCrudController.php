<?php

namespace App\Controller\Admin;

use App\Entity\Gamers;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class GamersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gamers::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('season'),
            AssociationField::new('team'),
            AssociationField::new('player'),
            Field::new('game'),
            Field::new('goal'),
            Field::new('gameTeam')->onlyOnForms(),
            Field::new('goalTeam')->onlyOnForms(),
            Field::new('assist')->onlyOnForms(),
            Field::new('score')->onlyOnForms(),
            Field::new('totalGame'),
            Field::new('totalGoal'),
            Field::new('born'),
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