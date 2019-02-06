<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Steam\FbstatBundle\Repository\TeamRepository;

class RfplmatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $season = $options['season'];
        if (!in_array('tour', $_SESSION)) {
            $_SESSION['tour']=1;
        }
        if (!in_array('date', $_SESSION)) {
            $_SESSION['date']=new \DateTime();
        }
        $builder
            ->add('tour', null, ['data' => $_SESSION['tour']])
            ->add('data', null, ['data' => $_SESSION['date']])
            ->add('team', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($season) {
            return $repository->queryTeamsForForm('Россия', $season);
            }
            ])
            ->add('team2', EntityType::class, [
            'class' => Team::class,
            'query_builder' => function (TeamRepository $repository) use ($season) {
            return $repository->queryTeamsForForm('Россия', $season);
            }
            ])
            ->add('goal1')
            ->add('goal2')
            ->add('bomb');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'Steam\FbstatBundle\Entity\Rfplmatch',
            ]);
        $resolver->setOptional(['country', 'season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rfplmatch';
    }
}
