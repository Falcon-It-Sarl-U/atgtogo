<?php

namespace App\Form\Admin;

use App\Entity\Admin\Temoignage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class TemoignageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
            ->add('auteur',TextType::class, [ 
                'label' => 'Nom auteur*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'ex: Jean Picasso', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('profession',TextType::class, [ 
                'label' => 'Profession*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'ex : Menusier', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Temoignage::class,
        ]);
    }
}
