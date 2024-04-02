<?php

namespace App\Controller\Admin;

use App\Entity\MundialTable;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MundialTableCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MundialTable::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('year'),
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
            ->add('year')
            ->add('country')
        ;
    }
    
}
