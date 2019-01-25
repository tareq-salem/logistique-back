<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Offer;
use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\DBAL\Types\TextType;

class OfferType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $builder->getData();

        $builder
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
            ->add('city', EntityType::class, [
                'class'  => Location::class,
                'multiple' => true,
                'mapped' => false,
                'query_builder' => function (LocationRepository $locationRepository) {
                    return $locationRepository->createQueryBuilder('l')
                        ->orderBy('l.city','ASC');
                },
                'choice_label' => 'city',
                'data' => $data->getLocations()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
