<?php

namespace App\Form\Admin;

use App\Entity\Admin\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('aproposCompagnie', TextType::class, [
                'label' => 'A propos*',
                'constraints' => new Length(['min' => 2, 'max' => 300]),
                'attr' => [
                    'placeholder' => 'Lome-TOGO',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse*',
                'constraints' => new Length(['min' => 2, 'max' => 120]),
                'attr' => [
                    'placeholder' => 'Lome-TOGO',
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
            ->add('email', EmailType::class, [
                'label' => 'Email*',
                'constraints' => new Length(['min' => 2, 'max' => 30]),
                'attr' => [
                    'placeholder' => 'ex: abc@email.com',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
            ->add('email2', EmailType::class, [
                'label' => 'Email 2*',
                'constraints' => new Length(['min' => 2, 'max' => 30]),
                'attr' => [
                    'placeholder' => 'ex: abc@email.com',
                    'class' => 'mb-3 form-control',
                    'id' => 'exampleInputNumber',

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
