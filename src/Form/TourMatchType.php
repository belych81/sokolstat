<?php

namespace App\Form;

use App\Entity\Tour;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\TeamRepository;

class TourMatchType extends AbstractType
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
        $season = $options['season'];
        if (!in_array('tour', $_SESSION)) {
            $_SESSION['tour']=1;
        }
        if (!in_array('date', $_SESSION)) {
            $_SESSION['date'] = new \DateTime();
        }

        $builder
            ->add('tour', null, ['data' => $_SESSION['tour']])
            ->add('data', null, ['data' => $_SESSION['date'], 'years' => range(1991, 2023)])
            ->add('team', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($country, $season) {
            return $repository->queryTeamsForForm($country, $season);
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($country, $season) {
            return $repository->queryTeamsForForm($country, $season);
            }
            ])
            ->add('goal1')
            ->add('goal2')
            ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tour::class
        ]);
        $resolver->setDefined(['country', 'season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tourmatch';
    }
}
