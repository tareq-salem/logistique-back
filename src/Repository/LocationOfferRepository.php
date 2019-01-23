<?php

namespace App\Repository;

use App\Entity\LocationOffer;
use App\Utils\Slugger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LocationOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationOffer[]    findAll()
 * @method LocationOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationOfferRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LocationOffer::class);
    }

    /**
     * Requète qui va créer le slug de l'offre
     * @return String $slug
     */
    public function createSlug(LocationOffer $locationOffer) {
        $URL_PREFIX = 'logisticc-recrute-';

        $TitreOffre = $locationOffer->getOffer()->getTitle();
        $TypeDeContrat = $locationOffer->getOffer()->getContratType()->getName();
        $TypeOffre = $locationOffer->getOffer()->getOfferType()->getName();
        $CodePostal = $locationOffer->getLocation()->getPostalCode();
        $Ville = $locationOffer->getLocation()->getCity();

        $slug = $URL_PREFIX . $TitreOffre . $TypeDeContrat . $TypeOffre . $CodePostal . $Ville;
        $slugger = new Slugger();
        $slugger->slugify($slug);
        return $slugger;
    }

    // /**
    //  * @return LocationOffer[] Returns an array of LocationOffer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LocationOffer
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
