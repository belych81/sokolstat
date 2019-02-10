<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Rusplayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PlayerType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
            ->add('name')
            ->add('country')
            ->add('translit')
            ->add('born', null, ['years' => \range(\date('Y'), 1955)])
            ->add('amplua')
        ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => Player::class
    ]);
  }
}
