<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FnlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $season = $options['season'];

        $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) use ($season) {
            return $repository->queryFnlPlayers($season);
            }
            ])
            ->add('goal');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['team', 'season']);
    }
}
