<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class NationCupAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
       );

    /*public function getNewInstance() {
        $instance = parent::getNewInstance();
        $em = $this->getModelManager()->getEntityManager('Steam\FbstatBundle\Entity\Season');
        $seasonReference = $em->getReference('Steam\FbstatBundle\Entity\Season', 51);
        $instance->setSeason($seasonReference);
        return $instance;
    }*/

        protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('country')
            ->add('season')
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
            ->add('country')
            ->add('season')
            ->add('data')
            ->add('stadia')
            ->add('team')
            ->add('team2')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('data')
            ->add('team.name')
            ->add('team2.name')
            ->add('score')
            ->add('bomb')
        ;
    }
}
