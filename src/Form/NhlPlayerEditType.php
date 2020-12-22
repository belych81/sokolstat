<?php

namespace App\Form;

use App\Entity\NhlPlayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\NhlPlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NhlPlayerEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
            ->add('name')
            ->add('amplua')
            ->add('country')
            ->add('translit')
            ->add('born', null, ['years' => \range(\date('Y'), 1920)])
            ->add('gameReg')
            ->add('goalReg')
            ->add('assistReg')
            ->add('scoreReg')
            ->add('missedReg')
            ->add('zeroReg')
            ->add('gamePlayOff')
            ->add('goalPlayOff')
            ->add('assistPlayOff')
            ->add('scorePlayOff')
            ->add('missedPlayOff')
            ->add('zeroPlayOff')
            ->add('gameSum')
            ->add('goalSum')
            ->add('assistSum')
            ->add('scoreSum')
            ->add('missedSum')
            ->add('zeroSum')
        ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => NhlPlayer::class
    ]);
  }
}
