<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CupLeagueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $country = 'england';
        $season = $options['season'];
        $builder
            ->add('stadia')
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
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
        $resolver->setDefined(['season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cupleague';
    }
}
