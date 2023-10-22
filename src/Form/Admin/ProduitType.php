<?php

namespace App\Form\Admin;

use App\Entity\Admin\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [ 
                'label' => 'Nom*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('description1', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('description2', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('avantage',TextType::class, [ 
                'label' => 'Avantage*', 
                'constraints' => new Length(['min' => 2, 'max' => 200]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('avantage2',TextType::class, [ 
                'label' => 'Avantage*', 
                'constraints' => new Length(['min' => 2, 'max' => 200]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('avantage3',TextType::class, [ 
                'label' => 'Avantage*', 
                'constraints' => new Length(['min' => 2, 'max' => 200]), 
                'attr' => [ 
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'mb-3 form-control', 
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
            'data_class' => Produit::class,
        ]);
    }
}
