<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class EcplayerAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'season'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('season')
            ->add('team')
            ->add('player')
            ->add('turnir')
            ->add('game')
            ->add('goal')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('season')
            ->add('player')
            ->add('team')
            ->add('turnir')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('season.name')
            ->add('player.name')
            ->add('team.name')
            ->add('turnir')
            ->add('game')
            ->add('goal')
        ;
    }
}
