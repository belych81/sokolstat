<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class PlayerAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        //$formMapper->add('name', TextType::class);
        $formMapper
            ->add('name')
            ->add('translit')
            ->add('amplua')
            ->add('country')
            ->add('born', DateType::class, array('years' => range(1955, date('Y'))))
            ->add('game')
            ->add('goal')
            ->add('cup')
            ->add('supercup')
            ->add('eurocup')
            ->add('sum')
            ->add('lch_goal')
            ->add('lch_game')
            ->add('image')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('translit')
            ->add('amplua')
            ->add('country')
            ->add('born')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        //$listMapper->addIdentifier('name');
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('translit')
            ->add('born')
            ->add('game')
            ->add('goal')
            ->add('cup')
            ->add('supercup')
            ->add('eurocup')
            ->add('sum')
            ->add('lch_game')
            ->add('lch_goal')
            ->add('country.name')
        ;
    }
}
