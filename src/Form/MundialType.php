<?php

namespace App\Form;

use App\Entity\Mundial;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\CountryRepository;

class MundialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $season = $options['season'];

        if (!in_array('data', $_SESSION)) {
            $_SESSION['data'] = new \DateTime();
        }

        $builder
            ->add('country2')
            ->add('goal')
            ->add('score')
            ->add('game')
            ->add('game2')
            ->add('penalty')
            ->add('data', null, ['data' => $_SESSION['data'], 'years' => range(1990, 2026)])
            ->add('zriteli')
            ->add('country')
            ->add('turnir')
            ->add('stadia')
            ->add('city')
            ->add('referee');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mundial::class
        ]);
        $resolver->setDefined(['season', 'turnir']);
    }
}
