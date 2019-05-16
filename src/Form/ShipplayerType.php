<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Rusplayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ShipplayerType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
        $season = $options['season'];
        $team = $options['team'];

        $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) use ($season, $team) {
              return $repository->queryLchPlayers($season, $team);
            }
            ])
            ->add('game', null, ['data' => 0])
            ->add('goal', null, ['data' => 0])
            ->add('cup', null, ['data' => 0])
            ->add('supercup', null, ['data' => 0])
            ->add('eurocup', null, ['data' => 0]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefined(['team', 'season']);
  }
}
