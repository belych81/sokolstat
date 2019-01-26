<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class RusplayerAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('player')
            ->add('game')
            ->add('goal')
            ->add('totalgame')
            ->add('totalgoal')
            ->add('sbGame')
            ->add('sbGoal')
            ->add('fnlGame')
            ->add('fnlGoal')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('player')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('player')
            ->add('game')
            ->add('goal')
            ->add('totalgame')
            ->add('totalgoal')
            ->add('sbGame')
            ->add('sbGoal')
            ->add('fnlGame')
            ->add('fnlGoal')
                ;
    }
}
