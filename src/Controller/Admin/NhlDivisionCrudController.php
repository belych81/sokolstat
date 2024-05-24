<?php

namespace App\Controller\Admin;

use App\Entity\NhlDivision;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NhlDivisionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NhlDivision::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('conf'),
            Field::new('name'),
        ];
    }
}
