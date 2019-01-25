<?php

namespace App\Repository;

use App\Entity\Candidature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Candidature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidature[]    findAll()
 * @method Candidature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatureRepository extends ServiceEntityRepository
{
    private $now;
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Candidature::class);
        $this->now = new \DateTime();
    }

    // /**
    //  * @return Candidature[] Returns an array of Candidature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Candidature
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*** POST TO BDD **/

    /**
     * /!\  le flush() se fait dans la fonction d'appel
     * @param $candidate
     * @param $lm
     * @param $cv
     * @param $message
     */
    public function insertNewCandidature($lm,$cv,$message,$candidate) {
        $candidature = new Candidature();

        $candidature->setCoverLetter($cv);
        $candidature->setResume($lm);
        $candidature->setMessage($message);

        $candidature->setIsActive(true);
        $candidature->setCandidate($candidate);
        $candidature->setSubmitDate($this->now);

        return $candidature;

        // /!\  le flush() se fait dans la fonction d'appel : avec une injection de dépendance EntityManagerInterface $em ($em->flush)

    }

    /*** GET FROM BDD **/

    /**
     * @param int $limit
     * @return Candidature[]
     */
    public function findByLatestLimitedBy(int $limit){
        return $this->findBy(
            [],
            ['created_at' => 'DESC'],
            $limit
        );
    }
}
