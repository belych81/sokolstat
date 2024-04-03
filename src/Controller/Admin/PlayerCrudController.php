<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('country'),
            Field::new('name'),
            AssociationField::new('amplua')->onlyOnForms(),
            Field::new('born'),
            Field::new('game'),
            Field::new('goal'),
            Field::new('lch_game'),
            Field::new('lch_goal'),
            Field::new('cup')->onlyOnForms(),
            Field::new('supercup')->onlyOnForms(),
            Field::new('eurocup')->onlyOnForms(),
            Field::new('sbornie')->onlyOnForms(),
            Field::new('sum'),
            Field::new('translit')->onlyOnForms(),
            Field::new('image')->onlyOnForms(),
            Field::new('insertdate')->onlyOnForms(),
            Field::new('viewed'),
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

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setDefaultSort([
                'sum' => 'DESC',
                'id' => 'ASC',
            ]);
    }
}
