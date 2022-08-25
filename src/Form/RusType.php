<?php

namespace App\Form;

use App\Entity\Player;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $season = $options['season'];
        $team = $options['team'];

        $builder
            ->add('player', EntityType::class, [
                'class' => Player::class,
                'query_builder' => function (PlayerRepository $repository) use ($season, $team) {
                    return $repository->queryRusTeamPlayers($season, $team);
                }
            ])
            ->add('goal');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['team', 'season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fnl';
    }
}
