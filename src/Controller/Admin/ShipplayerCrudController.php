<?php

namespace App\Controller\Admin;

use App\Entity\Shipplayer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ShipplayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shipplayer::class;
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
            Field::new('cup'),
            Field::new('supercup'),
            Field::new('eurocup'),
            Field::new('sbornie'),
            Field::new('sum'),
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