<?php

namespace App\Form\Admin;

use App\Entity\Admin\Apropos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AproposType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class, [ 
                'label' => 'Titre*', 
                'constraints' => new Length(['min' => 2, 'max' => 120]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('valeur',TextType::class, [ 
                'label' => 'Valeur*', 
                'constraints' => new Length(['min' => 2, 'max' => 120]), 
                'attr' => [ 
                    'placeholder' => 'ex: notre valeur..', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('valeur2',TextType::class, [ 
                'label' => 'valeur 2', 
                'constraints' => new Length(['min' => 2, 'max' => 120]), 
                'attr' => [ 
                    'placeholder' => 'ex: notre valeur..', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('valeur3',TextType::class, [ 
                'label' => 'Valeur 3*', 
                'constraints' => new Length(['min' => 2, 'max' => 120]), 
                'attr' => [ 
                    'placeholder' => 'ex: notre valeur..', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('valeur4',TextType::class, [ 
                'label' => 'Valeur 4*', 
                'constraints' => new Length(['min' => 2, 'max' => 120]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('nom_directeur',TextType::class, [ 
                'label' => 'Nom du DG*', 
                'constraints' => new Length(['min' => 2, 'max' => 120]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apropos::class,
        ]);
    }
}
