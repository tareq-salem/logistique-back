<?php

namespace App\Repository;

use App\Entity\SuperClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuperClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperClass[]    findAll()
 * @method SuperClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperClassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuperClass::class);
    }

    // /**
    //  * @return SuperClass[] Returns an array of SuperClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SuperClass
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
