<?php

namespace App\Form;

use App\Entity\NhlPlayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\NhlPlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NhlChampType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
        $season = $options['season'];
        $team = $options['team'];
        $flag = $options['flag'];
        $club = $options['club'];

        $builder
            ->add('player', EntityType::class, [
            'class' => NhlPlayer::class,
            'query_builder' => function (NhlPlayerRepository $repository) use ($season,
             $team, $flag, $club) {
               switch($flag){
                 /*case 'team':
                  return $repository->queryTeamPlayers($season, $team);
                  break;
                case 'country':
                   return $repository->queryCountryPlayers($season, $team, $club->getCountry()->getName());
                   break;*/
                case 'all':
                   return $repository->queryPlayersteam($season, $team);
                   break;
               }
            }
            ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefined(['team', 'season', 'flag', 'club']);
  }
}
