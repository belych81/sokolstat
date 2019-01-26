<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class MundialAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'data'
       );

    /*public function getNewInstance() {
        $instance = parent::getNewInstance();
        $em = $this->getModelManager()->getEntityManager('Steam\FbstatBundle\Entity\Season');
        $seasonReference = $em->getReference('Steam\FbstatBundle\Entity\Season', 52);
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
            ->add('country')
            ->add('country2')
            ->add('score')
            ->add('goal')
            ->add('status')
            ->add('city')
            ->add('referee')
            ->add('game')
            ->add('game2')
            ->add('penalty')
            ->add('zriteli')
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('season')
            ->add('turnir')
            ->add('data')
            ->add('stadia')
            ->add('country')
            ->add('country2')
            ->add('score')
            ->add('goal')
            ->add('status')
            ->add('city')
            ->add('referee')
            ->add('game')
            ->add('game2')
            ->add('penalty')
            ->add('zriteli')
        ;
    }

     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('season')
            ->add('turnir')
            ->add('data')
            ->add('stadia')
            ->add('country')
            ->add('country2')
            ->add('score')
        ;
    }
}
