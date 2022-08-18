<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Lchplayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LchplayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $season = $options['season'];
        $team = $options['team'];
        $flag = $options['flag'];
        $club = $options['club'];
        $country = $club->getCountry()->getName();

        $builder
            ->add('player')
            ->add('game')
            ->add('goal', null, ['data' => 0]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults([
          'data_class' => Lchplayer::class
      ]);
      $resolver->setDefined(['season', 'team', 'flag', 'club']);
    }
}
