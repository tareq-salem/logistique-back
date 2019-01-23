<?php

// TOREMEMORY -- NE PAS PUSH

namespace App\DataFixtures;

use App\Entity\Candidate;
use App\Entity\Candidature;
use App\Entity\ContractType;
use App\Entity\Country;
use App\Entity\LocationOffer;
use App\Entity\Offer;
use App\Entity\OfferType;
use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Location;
use App\EventListener\AddDateTimeSubscriber;


class AppFixtures extends Fixture
{

    private $encoder;



    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

//        $faker = Factory::create('fr_FR');
        //CREATION DE L'ADMIN
        $dateTime = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $admin = new User();
        $admin->setLogin('admin');
        $password = $this->encoder->encodePassword($admin, 'password');
        $admin->setPassword($password);
        $admin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($admin);
        $manager->flush();

        $faker = Factory::create('fr_FR');


        //Faker table Country
        $country = null;
        $randomCountries = [];
        for ($i = 0; $i < 10; $i++)
        {
            $country = new Country();
            $country->setName($faker->country);
            $randomCountries [] = $country;
            $manager->persist($country);
        }
        $manager->flush();

        //Faker table Candidate
        $candidate = null;
        $randomCandidates = [];

        for ($i = 0; $i < 10; $i++)
        {
            $candidate = new Candidate();
            $candidate->setFirstname($faker->name);
            $candidate->setLastname($faker->name);
            $candidate->setEmail($faker->email);
            $randomCandidates [] = $candidate;

            $manager->persist($candidate);
        }
        $manager->flush();

        //Faker table Location
        $location = null;
        $randomLocations = [];

        for ($i = 0; $i < 10; $i++)
        {
            $location = new Location();
            $location->setCountry($faker->randomElement($randomCountries));
            $location->setCity($faker->city);
            $location->setLatitude($faker->latitude);
            $location->setLongitude($faker->longitude);
            $location->setPostalCode($faker->postcode);
            $randomLocations [] = $location;


            $manager->persist($location);
        }
        $manager->flush();


        //Faker table STATUS
        $status = null;
        $statusName = ['Cadre','Ouvrier','Alternant'];
        $randomStatus = array();

        for ($i = 0; $i < count($statusName); $i++)
        {
            $status = new Status();
            $status->setName($statusName[$i]);
            $status->setIsActive($faker->boolean);
            $randomStatus[] = $status;
            $manager->persist($status);
        }
        $manager->flush();

        //Faker table Contrat
        $contractType = null;
        $contractTypeName = ['CDI','CDD','INTERIM', 'Contrat de professionnalisation','Contrat d\'apprentissage'];
        $randomContractType = [];

        for ($i = 0; $i < count($contractTypeName); $i++)
        {
            $contractType = new ContractType();
            $contractType->setName($contractTypeName[$i]);
            $contractType->setColor($faker->hexcolor);
            $randomContractType[] = $contractType;
            $manager->persist($contractType);
        }
        $manager->flush();

        //Faker table OfferType
        $offerType = null;
        $offerTypeName = ['Ouvrier', 'Commercial', 'Ingenieur'];
        $randomOfferType = array();

        for ($i = 0; $i < count($offerTypeName) ; $i++)
        {
            $offerType = new OfferType();
            $offerType->setName($offerTypeName[$i]);
            $offerType->setIsActive($faker->boolean);
            $randomOfferType[] = $offerType;
            $manager->persist($offerType);
        }
        $manager->flush();



        // Faker table Offer
        $offer = null;
        $randomOffers = [];
        for ($i = 0; $i < 20; $i++) {
            $dateTime = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
            $offer = new Offer();
           // $offer->setCreatedAt($faker->DateTime( $dateTime, 'Europe/Paris'));

            $offer->setCreatedAt($faker->dateTimeBetween('-6 months', 'Europe/Paris'));
            $offer->setAvailability($faker->numerify('# Mois'));
            $offer->setBenefits($faker->text(200));
            $offer->setContratType($faker->randomElement($randomContractType));
            $offer->setDescription($faker->text(200));
            $offer->setDuration($faker->numerify('## Mois'));
            $offer->setEndPublicationDate($faker->dateTimeBetween('-4 months', '+2 months'));
            $offer->setHourPerWeek($faker->numerify('## par semaine'));
            $offer->setIsActive($faker->boolean);
            $offer->setOfferType($faker->randomElement($randomOfferType));
            $offer->setReference($faker->swiftBicNumber);
            $offer->setRequiredExperience($faker->numerify("# ans"));
            $offer->setRequiredProfil($faker->text($maxNbChars = 15));
            $offer->setSalary($faker->numerify("#### €/mois"));
            $offer->setTitle($faker->word);
            $offer->setStartPublicationDate($faker->dateTimeBetween('-6 months', '+3 months'));
            $offer->setStatus($faker->randomElement($randomStatus));
            $randomOffers [] = $offer;
            $manager->persist($offer);
        }
        $manager->flush();

        //Faker table LocationOffer
        $locationOffer = null;
        $randomLocationOffers = [];

        for ($i = 0; $i < 10; $i++)
        {
            $locationOffer = new LocationOffer();
            $locationOffer->setLocation($faker->randomElement($randomLocations));
            $locationOffer->setOffer($faker->randomElement($randomOffers));
            $locationOffer->setSlug($faker->slug(6));
            $randomLocationOffers [] = $locationOffer;

            $manager->persist($locationOffer);
        }
        $manager->flush();

        //Faker table Candidature
        $cvName = null;
        for ($i = 0; $i < 10; $i++)
        {
            $dateTime = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
            $candidature = new Candidature();
            $candidature->setMessage($faker->text(200));
            $candidature->setCoverLetter($cvName = $faker->name . 'pdf');
            $candidature->setResume('LM ' . $cvName . 'pdf');
            $candidature->setIsActive($faker->boolean);
            $candidature->setSubmitDate($dateTime);
            $candidature->setCandidate($faker->randomElement($randomCandidates));
            $candidature->setLocationOffer($faker->randomElement($randomLocationOffers));


            $manager->persist($candidature);
        }
        $manager->flush();
    }
}
