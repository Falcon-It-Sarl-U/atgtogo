<?php

namespace App\Form\Admin;

use App\Entity\Admin\Certification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CertificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [ 
                'label' => 'Nom de la certification*', 
                'constraints' => new Length(['min' => 2, 'max' => 90]), 
                'attr' => [ 
                    'placeholder' => 'Le titre', 
                    'class' => 'mb-3 form-control', 
                    'id' => 'exampleInputNumber', 
     
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description*',
                'constraints' => new Length(['min' => 2, 'max' => 800]),
                'attr' => [
                    'placeholder' => 'ex: ab cdefj', 

                    'class' => 'form-control',
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
            'data_class' => Certification::class,
        ]);
    }
}
