<?php

namespace App\Form\Admin\home;

use App\Entity\Admin\home\About;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AboutType extends AbstractType
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
            ->add('sousTitre',TextType::class, [ 
                'label' => 'Sous Titre*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => About::class,
        ]);
    }
}
