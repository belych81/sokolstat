<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\TeamRepository;

class TourMatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $country = $options['country'];
        $season = $options['season'];

        if($country == 'fnl'){
            $country = 'russia';
        } elseif($country == 'underleague-usa'){
            $country = 'usa';
        }
        
        $builder
            ->add('tour')
            ->add('data', null, ['data' => new \DateTime(), 'years' => range(1991, date('Y')+1)])
            ->add('team', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($country, $season) {
            return $repository->queryTeamsForForm($country, $season);
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($country, $season) {
            return $repository->queryTeamsForForm($country, $season);
            }
            ])
            ->add('goal1')
            ->add('goal2')
            ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
        $resolver->setDefined(['country', 'season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tourmatch';
    }
}
