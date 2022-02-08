<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EurocupTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $builder
          ->add('score')
          ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
    }

}
