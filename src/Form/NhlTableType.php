<?php

namespace App\Form;

use App\Entity\NhlTable;
use App\Entity\NhlTeam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\NhlTeamRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NhlTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $season = "1992-93";
        if(\key_exists('season', $_SESSION)){
          $season = $_SESSION['season'];
        }

        $division = "Норриса";
        if(\key_exists('division', $_SESSION)){
          $division = $_SESSION['division'];
        }

        $builder
            ->add('season', null, ['data' => $season])
            ->add('division', null, ['data' => $division])
            ->add('team', EntityType::class, [
                'class' => NhlTeam::class,
                'query_builder' => function (NhlTeamRepository $repository) {
                return $repository->queryTeamsForSeason();
                }
              ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NhlTable::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nhlseason';
    }
}
