<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at')
            ->add('modified_at')
            ->add('title')
            ->add('reference')
            ->add('is_active')
            ->add('end_publication_date')
            ->add('start_publication_date')
            ->add('salary')
            ->add('description')
            ->add('duration')
            ->add('hour_per_week')
            ->add('availability')
            ->add('required_profil')
            ->add('required_experience')
            ->add('benefits')
            ->add('status')
            ->add('offerType')
            ->add('contratType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
