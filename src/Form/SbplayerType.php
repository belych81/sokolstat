<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Sbplayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SbplayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $season = $options['season'];
        
        $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) use ($season) {
              return $repository->querySbPlayers($season);
            }
            ])
            ->add('goal', null, ['data' => 0]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults([
          'data_class' => Sbplayer::class
      ]);
      $resolver->setDefined(['season']);
    }
}
