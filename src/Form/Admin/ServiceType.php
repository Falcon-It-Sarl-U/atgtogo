<?php

namespace App\Form\Admin;

use App\Entity\Admin\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class, [ 
                'label' => 'Titre*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('description1', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 800]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('avantage1',TextType::class, [ 
                'label' => 'Avantage 1*', 
                'constraints' => new Length(['min' => 2, 'max' => 200]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('avantage2',TextType::class, [ 
                'label' => 'Avantage 2*', 
                'constraints' => new Length(['min' => 2, 'max' => 200]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('description2', TextareaType::class, [
                'label' => 'Description 2*',
                'constraints' => new Length(['min' => 2, 'max' => 500]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('benefice1',TextType::class, [ 
                'label' => 'Benefices *', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('benefice2',TextType::class, [ 
                'label' => 'Benefices 2*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('benefices3',TextType::class, [ 
                'label' => 'Benefices3*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('description3', TextareaType::class, [
                'label' => 'Description 3*',
                'constraints' => new Length(['min' => 2, 'max' => 500]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('image', FileType::class, ['data_class' => null,
            'attr' => [
                'placeholder' => 'text ici',
                'class' => 'mb-3 form-control',
                'id' => 'exampleInputNumber',

    ]
    
    ])
            ->add('image2', FileType::class, ['data_class' => null,
            'attr' => [
                'placeholder' => 'text ici',
                'class' => 'mb-3 form-control',
                'id' => 'exampleInputNumber',

    ]
    
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
