<?php

namespace App\Controller\Admin;

use App\Entity\NflMatch;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NflMatchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NflMatch::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('season'),
            AssociationField::new('team'),
            AssociationField::new('team2'),
            Field::new('status')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('season')
            ->add('team')
            ->add('team2')
            ->add('status')
        ;
    }
    
}
