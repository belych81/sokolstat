<?php

namespace App\Controller\Admin;

use App\Entity\NhlTeam;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NhlTeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NhlTeam::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('name'),
            Field::new('matches'),
            Field::new('translit')->onlyOnForms(),
            Field::new('image'),
            Field::new('image2'),
            TextField::new('color1')->onlyOnForms(),
            TextField::new('color2')->onlyOnForms(),
            TextField::new('color3')->onlyOnForms(),
            TextField::new('color4')->onlyOnForms(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
        ;
    }
    
}
