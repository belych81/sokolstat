<?php

namespace App\Controller\Admin;

use App\Entity\NhlPlayer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NhlPlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NhlPlayer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('country'),
            AssociationField::new('amplua'),
            Field::new('born'),
            Field::new('name'),
            Field::new('translit'),
            Field::new('goalSum'),
            Field::new('assistSum'),
            Field::new('scoreSum'),
            Field::new('gameSum'),
            Field::new('missedSum'),
            Field::new('zeroSum'),
            Field::new('scoreReg'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('country')
            ->add('name')
            ->add('amplua')
        ;
    }
    
}
