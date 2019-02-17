<?php

namespace App\Form;

use App\Entity\NationCup;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NationCupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $season = $options['season'];
        $country = $options['country'];
        if (!in_array('stadia', $_SESSION)) {
            $_SESSION['stadia']='1/16 финала';
        }
        if (!in_array('date', $_SESSION)) {
            $_SESSION['date']=new \DateTime();
        }
        $builder
            ->add('stadia')
            ->add('data', null, ['data' => $_SESSION['date']])
            ->add('team', EntityType::class, [
              'class' => Team::class,
              'query_builder' => function (TeamRepository $repository) use ($season, $country) {
              return $repository->queryTeamsForCup($country);
              }
            ])
            ->add('team2', EntityType::class, [
              'class' => Team::class,
              'query_builder' => function (TeamRepository $repository) use ($season, $country) {
              return $repository->queryTeamsForCup($country);
              }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NationCup::class
        ]);
        $resolver->setDefined(['season', 'country']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cup';
    }
}
