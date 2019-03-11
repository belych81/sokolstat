<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class EurocupAdmin extends AbstractAdmin
{
  protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'data'
       );

    /*public function getNewInstance() {
        $instance = parent::getNewInstance();
        $em = $this->getModelManager()->getEntityManager('Steam\FbstatBundle\Entity\Season');
        $seasonReference = $em->getReference('Steam\FbstatBundle\Entity\Season', 53);
        $instance->setSeason($seasonReference);
        return $instance;
    }*/

        protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('season')
            ->add('turnir')
            ->add('data')
            ->add('stadia')
            ->add('team')
            ->add('team2')
            ->add('score')
            ->add('bomb')
            ->add('status')
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('season')
            ->add('turnir')
            ->add('stadia')
            ->add('data')
            ->add('team')
            ->add('team2')
            ->add('status')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('season.name')
            ->add('data')
            ->add('team.name')
            ->add('team2.name')
            ->add('turnir.name')
            ->add('stadia.name')
            ->add('score')
        ;
    }
}
