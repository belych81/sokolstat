<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\NhlPlayer;
use App\Entity\NhlTeam;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NhlRegType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('season')
            ->add('team', EntityType::class, array(
              'class' => NhlTeam::class,
              'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('t')
                ->orderBy('t.name', 'ASC');
                }
            ))
            ->add('player', EntityType::class, array(
              'class' => NhlPlayer::class,
              'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('p')
                ->orderBy('p.name', 'ASC');
                }
            ))
            ->add('goal')
            ->add('save', SubmitType::class)
        ;
    }

}
