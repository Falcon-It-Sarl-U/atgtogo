<?php

namespace App\Form\Admin;

use App\Entity\Admin\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('paragraphe1', TextareaType::class, [
                'label' => 'Paragraphe 1*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('paragraphe2', TextareaType::class, [
                'label' => 'Paragraphe 2*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('date',DateType::class)
            ->add('auteur',TextType::class, [ 
                'label' => 'Nom auteur*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'ex: Jean Picasso', 
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
