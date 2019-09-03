<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FnlplayerUpdateType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
        $season = $options['season'];
        $team = $options['team'];

        $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) use ($season, $team) {
              return $repository->queryUpdateFnlPlayers($season, $team);
            }
            ])
            ->add('game', null, ['data' => 0])
            ->add('goal', null, ['data' => 0]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefined(['team', 'season']);
  }
}
