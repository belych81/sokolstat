<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class ShipplayerAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
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
            ->add('player')
            ->add('season')
            ->add('team')
            ->add('game')
            ->add('goal')
            ->add('cup')
            ->add('supercup')
            ->add('eurocup')
            ->add('sum')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('season')
            ->add('team')
            ->add('player')
        ;
    }

  protected function configureListFields(ListMapper $listMapper)
   {
       $listMapper
           ->addIdentifier('id')
           ->add('player.name')
           ->add('season.name')
           ->add('team.name')
           ->add('game')
           ->add('goal')
           ->add('cup')
           ->add('supercup')
           ->add('eurocup')
           ->add('sum')
       ;
   }
}
