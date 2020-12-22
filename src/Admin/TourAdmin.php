<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class TourAdmin extends AbstractAdmin
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
            ->add('data', DateType::class, array('years' => range(1990, date('Y')+4)))
            ->add('team')
            ->add('team2')
            ->add('tour')
            ->add('goal1')
            ->add('goal2')
            ->add('bomb')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('country')
            ->add('season')
            ->add('data')
            ->add('tour')
            ->add('team')
            ->add('team2')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('country.name')
            ->add('season.name')
            ->add('data')
            ->add('team.name')
            ->add('team2.name')
            ->add('goal1')
            ->add('goal2')
            ->add('bomb')
        ;
    }
}
