<?php

namespace App\Form;

use App\Entity\Player;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SostavType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $year = $options['year'];
        $country = $options['country'];

        $builder
            ->add('player', EntityType::class, [
            'class' => Player::class,
            'query_builder' => function (PlayerRepository $repository) use
              ($year, $country) {
              return $repository->queryMundPlayers($year, $country);
              }
            ])
            ->add('team')
            ->add('number');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefined(['year', 'country']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sostav';
    }
}
