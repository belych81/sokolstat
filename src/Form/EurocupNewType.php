<?php

namespace App\Form;

use App\Entity\Eurocup;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EurocupNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $season = $options['season'];
      $data = $options['date'];

      $builder
          ->add('bomb')
          ->add('score')
          ->add('team')
          ->add('team2')
          ->add('data', null, ['data' => $data, 'years' => range(1990, 2026)])
          ->add('turnir')
          ->add('number')
          ->add('stadia');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eurocup::class
        ]);
        $resolver->setDefined(['season', 'date']);
    }

}
