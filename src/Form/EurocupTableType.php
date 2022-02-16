<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\Player;
use App\Repository\PlayerRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EurocupTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $season = $options['season'];

      $builder
      ->add('city')
      ->add('referee')
      ->add('zriteli')
      ->add('score')
      ->add('game')
      ->add('game2')
      ->add('penalty')
      ->add('player', EntityType::class, [
        'class' => Player::class,
        'query_builder' => function (PlayerRepository $repository) use ($season) {
            return $repository->queryRfplTrainers($season);
          }
      ])
      ->add('player2', EntityType::class, [
        'class' => Player::class,
        'query_builder' => function (PlayerRepository $repository) use ($season) {
            return $repository->queryRfplTrainers($season);
          }
      ])
      ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
        $resolver->setDefined(['season']);
    }

}
