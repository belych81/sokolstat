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

        $builder
            ->add('country2')
            ->add('data', null, ['data' => new \DateTime(), 'years' => range(1990, 2026)])
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
