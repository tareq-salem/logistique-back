<?php

namespace App\Repository;

use App\Entity\LocationOffer;
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
