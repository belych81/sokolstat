<?php

namespace App\Form;

use App\Entity\Mundial;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MundialUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $builder
        ->add('country2')
        ->add('goal', null, [
           'attr' => ['size' => '70']
         ])
        ->add('score')
        ->add('game', null, [
           'attr' => ['size' => '150']
         ])
        ->add('game2', null, [
           'attr' => ['size' => '150']
         ])
        ->add('penalty', null, [
           'attr' => ['size' => '70']
         ])
        ->add('zriteli')
        ->add('country')
        ->add('city')
        ->add('referee');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mundial::class
        ]);
    }

}
