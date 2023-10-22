<?php

namespace App\Form\Home;

use App\Entity\Home\Slide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SlideType extends AbstractType
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
            ->add('description', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 500]),
                'attr' => [
                    'placeholder' => 'text ici',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Slide::class,
        ]);
    }
}
