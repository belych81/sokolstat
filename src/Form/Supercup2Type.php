<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Supercup2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $country = $options['country'];

        $builder
          ->add('data', null, ['years' => \range(1992, \date('Y')+1)])
          ->add('score')
          ->add('bomb');

        if($country == 'uefa' || $country == 'russia')
        {
          $builder
            ->add('game')
            ->add('game2');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['country']);
    }
}
