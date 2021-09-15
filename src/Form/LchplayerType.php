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

        $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) use ($season, $team, $flag, $club) {
              switch($flag){
                case 'team':
                 return $repository->queryTeamPlayers($season, $team);
                 break;
               case 'country':
                  return $repository->queryCountryPlayers($season, $team, $club->getCountry()->getName());
                  break;
               case 'top5':
                   return $repository->queryTop5Players($season, $club->getCountry()->getName());
                   break;
               case 'lch':
                   return $repository->queryLChampPlayers($season);
                   break;
               case 'mund':
                   return $repository->queryMundialPlayers($season);
                   break;
               case 'all':
                  return $repository->queryLchPlayers($season, $team);
              }
            }
            ])
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
