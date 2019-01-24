<?php

namespace App\Repository;

use App\Entity\LocationOffer;
use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{

    private $limit;
    private $dateNow;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Offer::class);
        $this->dateNow = new \DateTime;
    }

    /**
     * Renvoie l'offre correspondant au slug
     */
    public function findOne() {
        //TODO
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

*/

    /**
     * @param string $slug
     *
    select *
    from offer o
    WHERE date(NOW()) > o.start_publication_date
    AND date(now()) < o.end_publication_date
    AND o.is_active = 1
    ORDER BY o.created_at = 'DESC';
     *
     */

    public function finOneBySlug($slug){

        return $request = $this->createQueryBuilder('o')
            ->join('o.location_id', 'l')
            ->andWhere('l.slug = :slug')
            ->setParameter('slug', $slug)
            ->addSelect('t')
            ->getQuery()
            ->getResult()
            ;

    }
    public function search($term)
    {
        return $this->createQueryBuilder('cat')
           /* ->andWhere('cat.id LIKE :searchTerm
                OR cat.iconKey LIKE :searchTerm
                OR fc.fortune LIKE :searchTerm')*/

            ->andWhere('cat.location_id = :searchTerm')

            ->leftJoin('cat.slug', 'fc')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->getQuery()
            ->execute();
    }


    public function  findAllActualActive() {
       return $requests =  $this->createQueryBuilder('o')
           ->where('o.is_active = 1')
            ->andWhere('o.start_publication_date < :beforenow')
            ->andWhere('o.end_publication_date > :afternow')

            ->setParameter("beforenow", $this->dateNow)
            ->setParameter("afternow", $this->dateNow)

            ->orderBy('o.created_at', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    public function test(){

    }
   /**
     * Request all offer Active and order by descendant
     * @param $limit
     * @return Offer[]
     */
    public function findByLatestLimitedBy($limit = null){
        $this->limit =  $limit;

        if($limit === 0 || $limit === null){
            $this->limit = null;
        }

        return $this->findBy(
            [],
            ['created_at' => 'DESC'],
            $this->limit
        );
    }
}
