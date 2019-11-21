<?php

namespace App\Form;

use App\Entity\Eurocup;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Eurocup2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $builder
          ->add('data', null, ['years' => \range(1991, \date('Y')+1)])
          ->add('stadia')
          ->add('team')
          ->add('team2')
          ->add('score')
          ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eurocup::class
        ]);
    }

}
