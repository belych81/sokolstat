<?php

namespace App\Form;

use App\Entity\Shiptable;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\TeamRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShiptableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $country = $options['country'];
        if($country == 'fnl'){
          $country = 'russia';
        }
        $builder
            ->add('season')
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'query_builder' => function (TeamRepository $repository) use ($country) {
                return $repository->queryTeamsForCup($country);
                }
              ]
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shiptable::class
        ]);
        $resolver->setDefined(['country']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tourseason';
    }
}
