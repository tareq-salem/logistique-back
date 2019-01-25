<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

class PostulerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email',
                'constraints' => new Assert\Email([
                    'message' => 'The email "{{ value }}" is not a valid email.', 
                    'checkMX' => true, 
                ])
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('cv', FileType::class, [
                'label' => 'Curriculum vitae', 
                'attr' => ['class' => 'bg-color'],
                'constraints' => new Assert\File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'application/pdf',
                        'application/x-pdf',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid PDF',
                ]) 
            ])    
            ->add('lm', FileType::class, [
                'label' => 'Lettre de motivation',
                'attr' => ['class' => 'bg-color'],
                'constraints' => new Assert\File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'application/pdf',
                        'application/x-pdf',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid PDF',
                ])
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'textarea'],
                'constraints' => new Assert\Length([
                    'min' => 10,
                    'max' => 200,
                    'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                    'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                ]) 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
