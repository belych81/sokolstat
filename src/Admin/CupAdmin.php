<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class CupAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
       );

    /*public function getNewInstance()
    {
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
            ->add('stadia')
            ->add('team')
            ->add('team2')
            ->add('score')
            ->add('bomb')
            ->add('game')
            ->add('game2')
            ->add('data')
            ->add('status')
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('season')
            ->add('stadia')
            ->add('team')
            ->add('team2')
            ->add('score')
            ->add('bomb')
            ->add('game')
            ->add('game2')
            ->add('data')
            ->add('status')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
     {
        $listMapper
            ->addIdentifier('id')
            ->add('season.name')
            ->add('stadia.name')
            ->add('team.name')
            ->add('team2.name')
            ->add('score')
            ->add('bomb')
            ->add('data')
            ->add('status')
        ;
    }
}
