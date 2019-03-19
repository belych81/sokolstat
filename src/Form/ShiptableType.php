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
        switch ($country) {
            case 'russia' : $country = 'Россия'; break;
            case 'england' : $country = 'Англия';  break;
            case 'spain' : $country = 'Испания'; break;
            case 'italy' : $country = 'Италия'; break;
            case 'germany' : $country = 'Германия'; break;
            case 'france' : $country = 'Франция'; break;
            case 'fnl' : $country = 'ФНЛ'; break;
        }
        $season = "2010-11";
        if(\key_exists('season', $_SESSION)){
          $season = $_SESSION['season'];
        }
        $builder
            ->add('season', null, ['data' => $season])
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
