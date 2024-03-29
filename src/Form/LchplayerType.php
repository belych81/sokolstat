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
            ->add('game')
            ->add('goal', null, ['data' => 0]);

        if($flag != 'all'){
            $builder->add('player', EntityType::class, [
                'class' => Player::class,
                'query_builder' => function (PlayerRepository $repository) use ($season, $team, $flag, $country) {
                    switch($flag){
                        case 'team':
                        return $repository->queryTeamPlayers($season, $team, $country);
                        break;
                    case 'country':
                        return $repository->queryCountryPlayers($season, $team, $country);
                        break;
                    case 'top5':
                        return $repository->queryTop5Players($season, $country);
                        break;
                    case 'lch':
                        return $repository->queryLChampPlayers($season);
                        break;
                    case 'mund':
                        return $repository->queryMundialPlayers($season);
                        break;
                    }
                }
            ]);             
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults([
          'data_class' => Lchplayer::class,
          'allow_extra_fields' => true
      ]);
      $resolver->setDefined(['season', 'team', 'flag', 'club']);
    }
}
