<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CountryAdmin extends AbstractAdmin
{
      protected $datagridValues = array(
          '_sort_order' => 'DESC',
          '_sort_by' => 'id'
      );

      protected function configureFormFields(FormMapper $formMapper)
      {
          $formMapper
              ->add('name')
              ->add('translit')
          ;
      }

      protected function configureDatagridFilters(DatagridMapper $datagridMapper)
      {
          $datagridMapper
              ->add('name')
              ->add('translit')
          ;
      }

      protected function configureListFields(ListMapper $listMapper)
      {
          $listMapper
              ->addIdentifier('id')
              ->add('name')
          ;
      }
}
