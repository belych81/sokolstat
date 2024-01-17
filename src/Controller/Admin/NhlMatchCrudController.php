<?php

namespace App\Controller\Admin;

use App\Entity\NhlMatch;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NhlMatchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NhlMatch::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id'),
            Field::new('data'),
            AssociationField::new('team'),
            AssociationField::new('team2'),
            Field::new('goal1'),
            Field::new('goal2'),
            Field::new('bomb'),
        ];
    }
    
}
