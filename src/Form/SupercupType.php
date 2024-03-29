<?php

namespace App\Form;

use App\Entity\NationSupercup;
use App\Entity\RusSupercup;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SupercupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $country = $options['country'];
        $builder
            ->add('season')
            ->add('data', null, ['years' => \range(1992, \date('Y')+1)])
            ->add('team', EntityType::class, [
              'class' => Team::class,
              'query_builder' => function (TeamRepository $repository) use ($country) {
              return $repository->queryTeamsForCup($country);
              }
            ])
            ->add('team2', EntityType::class, [
              'class' => Team::class,
              'query_builder' => function (TeamRepository $repository) use ($country) {
              return $repository->queryTeamsForCup($country);
              }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['country']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'supercup';
    }
}
