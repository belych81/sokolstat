<?php

namespace App\Form;

use App\Entity\Cup;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $season = $options['season'];
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
            'query_builder' => function (TeamRepository $repository) use ($season) {
            return $repository->queryTeamsForCup('Россия');
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($season) {
            return $repository->queryTeamsForCup('Россия');
            }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cup::class
        ]);
        $resolver->setDefined(['season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cup';
    }
}
