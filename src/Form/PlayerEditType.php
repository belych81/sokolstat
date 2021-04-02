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

class PlayerEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
            ->add('name')
            ->add('amplua')
            ->add('country')
            ->add('translit')
            ->add('born', null, ['years' => \range(\date('Y'), 1920)])
            ->add('game')
            ->add('goal')
            ->add('image')
            ->add('cup')
            ->add('eurocup')
            ->add('supercup')
            ->add('sbornie')
            ->add('lch_game')
            ->add('lch_goal')
            ->add('sum')
        ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => Player::class
    ]);
  }
}
