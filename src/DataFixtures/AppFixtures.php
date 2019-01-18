<?php

namespace App\DataFixtures;

use App\Entity\ContractType;
use App\Entity\Offer;
use App\Entity\OfferType;
use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;
use App\Entity\User;


class AppFixtures extends Fixture
{

    private $encoder;



    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //CREATION DE L'ADMIN
        $dateTime = new \DateTime('now', new DateTimeZone('Europe/Paris'));
        $admin = new User();
        $admin->setLogin('admin');
        $password = $this->encoder->encodePassword($admin, 'password');
            
        $manager->persist($admin);
        $manager->flush();

        $faker = Factory::create('fr_FR');

        //Faker table STATUS
        for ($i = 0; $i < 10; $i++)
        {
            $status = new Status();
            $status->setName($faker->randomElements($statusName, $count = 1));
            $status->setIsActive($faker->boolean);
            $manager->persist($status);
        }
        $manager->flush();

        //Faker table Contrat
        for ($i = 0; $i < 10; $i++)
        {
            $contractType = new ContractType();
            $status->setName($faker->randomElements($contractTypeName, $count = 1));
            $status->setColor($faker->hexcolor);
            $manager->persist($contractType);
        }
        $manager->flush();

        //Faker table OfferType
        $offerTypeName = array('Ouvrier', 'Commercial', 'Ingenieur');

        for ($i = 0; $i < 10; $i++)
        {
            $offerType = new OfferType();
            $offerType->setName($faker->randomElements($offerTypeName, $count = 1));
            $offerType->setIsActive($faker->boolean);
            $manager->persist($offerType);
        }
        $manager->flush();

        // Faker table Offer
        $contractTypeName = array ('CDI','CDD','INTERIM', 'Contrat de professionnalisation','Contrat d\'apprentissage');

        $titleOffer = array ('Ouvrier specialise','Préparateur(trice) de commande (H/F) CDI/CDD',
                            'Ingénieur(e) qualité (H/F) CDI/CDD','Assistant(e) service client (H/F) CDI/CDD',
                            'Alternant Assistant Logistique (H/F) ', 'Directeur Logistique (H/F) CDD',
                            'Responsable exploitation plateforme logistique (H/F) CDI');

        $statusName = array ('Cadre','Ouvrier','Alternant');

        for ($i = 0; $i < 10; $i++) {
            $dateTime = new \DateTime('now', 'Europe/Paris');
            $offer = new Offer();
            $offer->setAvailability($faker->numerify('# Mois'));
            $offer->setBenefits($faker->sentences(3, false));
            $offer->setContratType($faker->randomElements($contractTypeName, $count = 1));
            $offer->setDescription($faker->text(200));
            $offer->setDuration($faker->numerify('## Mois'));
            $offer->setEndPublicationDate($faker->DateTime('2019-02-28 13:46:23', 'Europe/Paris'));
            $offer->setHourPerWeek($faker->numerify('## par semaine'));
            $offer->setIsActive($faker->boolean);
            $offer->setOfferType($faker->jobTitle);
            $offer->setReference($faker->swiftBicNumber);
            $offer->setRequiredExperience($faker->numerify("# ans"));
            $offer->setRequiredProfil($faker->text($maxNbChars = 15));
            $offer->setSalary($faker->numerify("#### €/mois"));
            $offer->setTitle($faker->randomElements($titleOffer, $count = 1));
            $offer->setStartPublicationDate($dateTime);
            $offer->setStatus($faker->randomElements($statusName, $count = 1));
            $manager->persist($offer);
        }
        $manager->flush();
    }
}
