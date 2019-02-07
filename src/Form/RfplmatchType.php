<?php

namespace App\Form;

use App\Entity\Rfplmatch;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rfplmatch::class
        ]);
        $resolver->setDefined(['country', 'season']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rfplmatch';
    }
}
