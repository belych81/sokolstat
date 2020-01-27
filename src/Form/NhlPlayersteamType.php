<?php

namespace App\Form;

use App\Entity\NhlPlayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\NhlPlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NhlPlayersteamType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
        $season = $options['season'];
        $team = $options['team'];

        $builder
            ->add('player', EntityType::class, [
            'class' => NhlPlayer::class,
            'query_builder' => function (NhlPlayerRepository $repository) use (
              $season, $team) {
                   return $repository->queryLchPlayers($season, $team);
            }
            ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefined(['team', 'season']);
  }
}
