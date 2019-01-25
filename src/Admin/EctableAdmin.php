<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class EctableAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'score'
    );

    /*public function getNewInstance() {
        $instance = parent::getNewInstance();
        $em = $this->getModelManager()->getEntityManager('Steam\FbstatBundle\Entity\Shiptable');
        $seasonReference = $em->getReference('Steam\FbstatBundle\Entity\Season', 55);
        $instance->setSeason($seasonReference);
        return $instance;
    }*/

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('season')
            ->add('turnir')
            ->add('stadia')
            ->add('team')
            ->add('wins')
            ->add('nich')
            ->add('porazh')
            ->add('mz')
            ->add('mp')
            ->add('score')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('season')
            ->add('team')
            ->add('turnir')
            ->add('stadia')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('team')
            ->add('wins')
            ->add('nich')
            ->add('porazh')
            ->add('mz')
            ->add('mp')
            ->add('score')
        ;
    }
}
