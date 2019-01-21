<?php

// TOREMEMORY -- NE PAS PUSH

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

//        $faker = Factory::create('fr_FR');
        //CREATION DE L'ADMIN
        $dateTime = new \DateTime();
        $admin = new User();
        $admin->setLogin('admin');
        //$password = $this->encoder->encodePassword($admin, 'password');
        $admin->setPassword('password');

        $manager->persist($admin);
        $manager->flush();


        //CREATION DE STATUS
        $statusCadre = new Status();
        $statusCadre->setName('Cadre');
        $statusCadre->setIsActive(true);

        $statusOuvrier = new Status();
        $statusOuvrier->setName('Ouvrier');
        $statusOuvrier->setIsActive(true);

        $statusAlternant= new Status();
        $statusAlternant->setName('Alternant');
        $statusAlternant->setIsActive(true);

        $manager->persist($statusCadre);
        $manager->persist($statusOuvrier);
        $manager->persist($statusAlternant);

        $manager->flush();

        //Creation Contrat

        $contractCdi = new ContractType();
        $contractCdi->setName('CDI');
        $contractCdi->setColor('red');

        $contractCdd = new ContractType();
        $contractCdd->setName('CDD');
        $contractCdd->setColor('blue');

        $contractInterimaire= new ContractType();
        $contractInterimaire->setName('Interimaire');
        $contractInterimaire->setColor('pink');

        $manager->persist($contractCdi);
        $manager->persist($contractCdd);
        $manager->persist($contractInterimaire);

        $manager->flush();

        //Creation Contrat

        $offerTypeOuvrier = new OfferType();
        $offerTypeOuvrier->setName('Ouvrier');
        $offerTypeOuvrier->setIsActive(true);

        $offerTypeCommercial = new OfferType();
        $offerTypeCommercial->setName('Commercial');
        $offerTypeCommercial->setIsActive(true);

        $offerTypeIngenieur= new OfferType();
        $offerTypeIngenieur->setName('Ingenieur');
        $offerTypeIngenieur->setIsActive(true);

        $manager->persist($offerTypeOuvrier);
        $manager->persist($offerTypeCommercial);
        $manager->persist($offerTypeIngenieur);

        $manager->flush();



        //CREATION D'OFFERS
        $salary = ['1100 a 1500', '1500 a 2000', '2000 a 3000'];
        $title = ['je', 'sais', 'rien'];
        $hourPerWeek = ['15h','20h', '35h'];
        $duration = ['six month', 'one year','three year'];
        $availability = ['yes', 'no'];

        $benefits = array("Nulla facilisi. Cras non velit nec nisi",
            "Phasellus sit amet erat. Nulla tempus",
            "rtor risus dapibus augue, vel accumsan tellus nisi eu orci.",
            "interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
            "pulvinar sed, nisl. Nunc rhoncus dui vel sem. Sed sagittis.",
            "apien quis libero.",
            "us purus, aliquet at, feugiat non, pretium quis, lectus.",
            "consectetuer eget, rutrum at, lorem. Integer tincidunt ante vel ipsum.",
            "sapien cursus vestibulum. Proin eu mi. Nulla ac enim.",
            ", nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.",
            "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat.",
            "lit ac nulla. Sed vel enim sit amet nunc viverra dapibus.",
            "Morbi non quam nec dui luctus rutrum.");

        $description = array("Nulla facilisi. Cras non velit nec nisi",
            "Phasellus sit amet erat. Nulla tempus",
            "rtor risus dapibus augue, vel accumsan tellus nisi eu orci.",
            "interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
            "pulvinar sed, nisl. Nunc rhoncus dui vel sem. Sed sagittis.",
            "apien quis libero.",
            "us purus, aliquet at, feugiat non, pretium quis, lectus.",
            "consectetuer eget, rutrum at, lorem. Integer tincidunt ante vel ipsum.",
            "sapien cursus vestibulum. Proin eu mi. Nulla ac enim.",
            ", nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.",
            "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat.",
            "lit ac nulla. Sed vel enim sit amet nunc viverra dapibus.",
            "Morbi non quam nec dui luctus rutrum.");

        $requiredProfil = array("Nulla facilisi. Cras non velit nec nisi",
            "PhaselNulla tempus",
            "rtor risus dapibus augue, vel accumsan tellus nisi eu orci.",
            "interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
            "pulvinar sed, nisl. Nunc rhoncus dui vel sem. Sed sagittis.",
            "apien quis libero.",
            "us purus, aliquet at, feugiat non, pretium quis, lectus.",
            "consectetuer eget, rutrum at, lorem. Integer tincidunt ante vel ipsum.",
            "sapien cursus vestibulum. Proin eu mi. Nulla ac enim.",
            ", nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.",
            "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat.",
            "lit ac nulla. Sed vel enim sit amet nunc viverra dapibus.",
            "Morbi non quam nec dui luctus rutrum.");



        $contractType = $manager->getRepository(ContractType::class)->findAll();
        $offerType = $manager->getRepository(OfferType::class)->findAll();
        $status = $manager->getRepository(Status::class)->findAll();


        for ($i = 0; $i < 20; $i++) {
            $dateTime = new \DateTime();
            $offer = new Offer();
            $offer->setCreatedAt($dateTime);
            $offer->setModifiedAt($dateTime);
            $offer->setAvailability($availability[mt_rand(0, 1)]);
            $offer->setBenefits($benefits[mt_rand(0, 10)]);
            $offer->setContratType($contractType[mt_rand(0, 2)]);
            $offer->setDescription($description[mt_rand(0, 10)]);
            $offer->setDuration( $duration[mt_rand(0, 2)]);
            $offer->setEndPublicationDate($dateTime);
            $offer->setHourPerWeek($hourPerWeek[mt_rand(0, 2)]);
            $offer->setIsActive(true);
            $offer->setOfferType($offerType[mt_rand(0, 2)]);
            $offer->setReference("referenceAdmin");
            $offer->setRequiredExperience("experience");
            $offer->setRequiredProfil($requiredProfil[mt_rand(0, 10)]);
            $offer->setSalary($salary[mt_rand(0, 2)]);
            $offer->setTitle($title[mt_rand(0, 2)]);
            $offer->setStartPublicationDate($dateTime);
            $offer->setStatus($status[mt_rand(0, 2)]);
            $manager->persist($offer);
        }
        $manager->flush();
    }
}
