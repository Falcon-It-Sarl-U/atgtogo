<?php

namespace App\Form\Admin;

use App\Entity\Admin\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_prenom', TextType::class, [
                'label' => 'Nom et Prenom*',
                'constraints' => new Length(['min' => 2, 'max' => 90]),
                'attr' => [
                    'placeholder' => 'Le titre',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            ->add('image', FileType::class, [
                'data_class' => null,
                'attr' => [
                    'placeholder' => 'text ici',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]

            ])
            ->add('profession', TextType::class, [
                'label' => 'Profession*',
                'constraints' => new Length(['min' => 2, 'max' => 90]),
                'attr' => [
                    'placeholder' => 'Le titre',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            // ->add('statut')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
