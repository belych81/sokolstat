<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class TeamAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'name'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('country')
            ->add('translit')
            ->add('image')
            ->add('image2')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('country')
            ->add('name')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
			      ->add('name')
            ->add('country.name')
        ;
    }
}
