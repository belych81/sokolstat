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

        if (!in_array('data', $_SESSION)) {
            $date = new \DateTime();
            //$date->modify("-2 year");
            $_SESSION['data'] = $date;
        }
        $builder
            ->add('data', null, ['data' => $_SESSION['data'], 'years' => \range(1991, \date('Y')+1)])
            ->add('stadia')
            ->add('team', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($turnir, $season) {
              return $repository->queryTeamsForEc($turnir, $season);
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($turnir, $season) {
              return $repository->queryTeamsForEc($turnir, $season);
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
