<?php

namespace App\Form;

use App\Entity\Ectable;
use App\Entity\Team;
use App\Entity\Stadia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\TeamRepository;
use App\Repository\StadiaRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EctableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $stadia = "groupA";
      if(\key_exists('stadia', $_SESSION)){
        $stadia = $_SESSION['stadia'];
      }
        $builder
            ->add('stadia', EntityType::class, [
              'data' => $stadia,
              'class' => Stadia::class,
              'query_builder' => function (StadiaRepository $repository) {
                return $repository->queryGroupStadia();
              }
            ])
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'query_builder' => function (TeamRepository $repository) {
                return $repository->queryTeams();
                }
              ]
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ectable::class
        ]);
        $resolver->setDefined(['turnir', 'season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ectable';
    }
}
