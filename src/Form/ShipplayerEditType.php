<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Shipplayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\ShipplayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ShipplayerEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
            ->add('season')
            ->add('team')
            ->add('player')
            ->add('game')
            ->add('goal')
            ->add('cup')
            ->add('eurocup')
            ->add('supercup')
            ->add('sum')
        ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => Shipplayer::class
    ]);
  }
}
