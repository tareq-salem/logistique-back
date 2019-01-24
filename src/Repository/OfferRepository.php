<?php

namespace App\Repository;

use App\Entity\LocationOffer;
use App\Entity\Offer;
use App\Utils\Slugger;
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
    private $slugger;

    public function __construct(RegistryInterface $registry, Slugger $slugger)
    {
        parent::__construct($registry, Offer::class);

        $this->slugger = $slugger;
    }

    /**
     * Renvoie l'offre correspondant au slug
     */
    public function findOne() {
        //TODO
    }

    /**
     * Requète qui va créer le slug de l'offre
     * @return String $slug
     */
    public function createSlug( Offer $offer) {
        $URL_PREFIX = 'logisticc-recrute-';

        $TitreOffre = $offer->getTitle();
        $TypeDeContrat = $offer->getContratType()->getName();
        $TypeOffre = $offer->getOfferType()->getName();
        $locationOffers = $offer->getLocationOffers();
        $CodePostal = null;
        $Ville = null;

        foreach ($locationOffers as $locationOffer)
        {
            $CodePostal = $locationOffer->getLocation()->getPostalCode();
            $Ville = $locationOffer->getLocation()->getCity();

            $slug = $URL_PREFIX . ' ' . $TitreOffre . ' ' . $TypeDeContrat . ' ' . $TypeOffre . ' ' . $CodePostal . ' ' . $Ville;
            $slug = $this->slugger->slugify($slug);

            $locationOffer->setSlug($slug);
        }

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

    public function allIsActive(){
        return $this->findBy(
            ['is_active' => 1],
            ['created_at' => 'DESC']
        );
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
    public function  findAllByDate() {
        $requests =  $this->createQueryBuilder('o')
            ->select('*')
            ->where('o.start_publication_date < date(NOW())')
            ->andWhere('o.end_publication_date > date(NOW())')
            ->andWhere('o.is_active = 1')
            ->orderBy('o.created_at','DESC')
            ->getQuery()
        ;

        //var_dump($requests);
        $requests =
            $this->findBy(
             ['start_publication_date' => '<  date(NOW()) '],
             ['created_at' => 'DESC'],
             5
            );
        return $requests;
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
            ['is_active' => 1],
            ['created_at' => 'DESC'],
            $this->limit
        );
    }
}
