<?php

namespace App\Form;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    // TODO Ajouter les type des fileds -> modiefied_at -> now et non modifiable dans le formulaire mais directement dans le controller
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('created_at')
            ->add('modified_at')
            ->add('name')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
