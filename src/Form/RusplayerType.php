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

class RusplayerType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) {
              return $repository->queryGamerByLastSeasons();
            }
            ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => Rusplayer::class
    ]);
  }
}
