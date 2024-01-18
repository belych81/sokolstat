<?php

namespace App\Controller\Admin;

use App\Entity\Mundial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MundialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mundial::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('turnir'),
            AssociationField::new('season'),
            Field::new('data'),
            AssociationField::new('country'),
            AssociationField::new('country2'),
            Field::new('score'),
            Field::new('goal'),
            Field::new('game')->onlyOnForms(),
            Field::new('game2')->onlyOnForms(),
            Field::new('penalty')->onlyOnForms(),
            AssociationField::new('city')->onlyOnForms(),
            AssociationField::new('referee')->onlyOnForms()
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('season')
            ->add('turnir')
            ->add('country')
            ->add('country2')
        ;
    }
}
