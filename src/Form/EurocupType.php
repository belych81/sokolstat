<?php

namespace App\Form;

use App\Entity\Eurocup;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EurocupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $turnir = $options['turnir'];
        $season = $options['season'];
        $stadia = $options['stadia'];

        if (!in_array('data', $_SESSION)) {
            $date = new \DateTime();
            //$date->modify("-2 year");
            $_SESSION['data'] = $date;
        }
        $builder
            ->add('data', null, ['data' => $_SESSION['data']])
            ->add('team', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($turnir, $season, $stadia) {
              return $repository->queryTeamsForEc($turnir, $season, $stadia);
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($turnir, $season, $stadia) {
              return $repository->queryTeamsForEc($turnir, $season, $stadia);
            }
            ])
            ->add('score')
            ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eurocup::class
        ]);
        $resolver->setDefined(['turnir', 'season', 'stadia']);
    }

}
