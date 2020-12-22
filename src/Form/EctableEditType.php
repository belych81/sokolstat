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

class EctableEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
              ->add('wins')
              ->add('nich')
              ->add('porazh')
              ->add('mz')
              ->add('mp')
              ->add('score')
          ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ectable::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ectable_edit';
    }
}
