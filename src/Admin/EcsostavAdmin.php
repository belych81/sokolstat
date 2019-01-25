<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class EcsostavAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('eurocup')
            ->add('team')
            ->add('team2')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('eurocup.id')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('eurocup.id')
            ->add('team')
            ->add('team2')
        ;
    }
}
