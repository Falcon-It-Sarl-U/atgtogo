<?php

namespace App\Form\Admin;

use App\Entity\Admin\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class MessageType extends AbstractType
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
            ->add('email', EmailType::class, [
                'label' => 'Email*',
                'constraints' => new Length(['min' => 2, 'max' => 30]),
                'attr' => [
                    'placeholder' => 'ex: abc@email.com',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Telephone*',
                'constraints' => new Length(['min' => 2, 'max' => 20]),
                'attr' => [
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            ->add('objet', TextType::class, [
                'label' => 'Objet*',
                'constraints' => new Length(['min' => 2, 'max' => 90]),
                'attr' => [
                    'placeholder' => 'ex: abc@email.com',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message*',
                'constraints' => new Length(['min' => 2, 'max' => 1000]),
                'attr' => [
                    'placeholder' => 'message', 
                    'class' => 'form-control',
                    'id' => 'exampleInputNumber',

        ]

    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
