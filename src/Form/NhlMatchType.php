<?php

namespace App\Form;

use App\Entity\NhlMatch;
use App\Entity\NhlTeam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\NhlTeamRepository;

class NhlMatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!in_array('date', $_SESSION)) {
            $_SESSION['date'] = new \DateTime();
        }

        $builder
            ->add('stadia')
            ->add('data', null, ['data' => $_SESSION['date'],
              'years' => range(1991, 2023)])
            ->add('team', EntityType::class, [
            'class' => NhlTeam::class,
            'query_builder' => function (NhlTeamRepository $repository) {
              return $repository->queryTeamsForSeason();
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => NhlTeam::class,
            'query_builder' => function (NhlTeamRepository $repository) {
              return $repository->queryTeamsForSeason();
            }
            ])
            ->add('goal1')
            ->add('goal2')
            ->add('bomb');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NhlMatch::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nhlmatch';
    }
}
