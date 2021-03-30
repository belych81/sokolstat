<?php

namespace App\Form;

use App\Entity\MundialTable;
use App\Entity\Country;
use App\Entity\Stadia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\StadiaRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MundialtableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $stadia = $options['stadia'] ?? "groupA";

        $builder
            ->add('stadia', EntityType::class, [
              //'data' => $stadia,
              'class' => Stadia::class,
              'query_builder' => function (StadiaRepository $repository) {
                return $repository->queryGroupStadia();
              }
            ])
            ->add('country');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MundialTable::class
        ]);
        $resolver->setDefined(['turnir', 'season', 'stadia']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mundialtable';
    }
}
