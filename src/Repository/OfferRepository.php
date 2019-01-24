<?php

namespace App\Repository;

use App\Entity\LocationOffer;
use App\Entity\Offer;
use App\Utils\Slugger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;

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
    private $dateNow;

    public function __construct(RegistryInterface $registry, Slugger $slugger)
    {
        parent::__construct($registry, Offer::class);

        $this->slugger = $slugger;
        $this->dateNow = new \DateTime;
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
    // public function createSlug(Offer $offer) {
    //     $TitreOffre = $offer->getTitle();
    //     $TypeDeContrat = $offer->getContratType()->getName();
    //     $TypeOffre = $offer->getOfferType()->getName();
    //     $locationOffers = $offer->getLocationOffers();

    //     foreach ($locationOffers as $locationOffer)
    //     {
    //         $CodePostal = $locationOffer->getLocation()->getPostalCode();
    //         $Ville = $locationOffer->getLocation()->getCity();

    //         $slug = $this->URL_PREFIX . ' ' . $TitreOffre . ' ' . $TypeDeContrat . ' ' . $TypeOffre . ' ' . $CodePostal . ' ' . $Ville;
    //         $slug = $this->slugger->slugify($slug);

    //         $locationOffer->setSlug($slug);
    //     }

    // }

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
     * carrières/offres
     *  select *
     *from offer o
     *WHERE date(NOW()) > o.start_publication_date
     *AND date(now()) < o.end_publication_date
     *AND o.is_active = 1
     * ORDER BY o.created_at = 'DESC';
     * @return Offer[]
     */
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
    /**
     *  @return 
     */
    public function findAllVisible(){

        return $this->findByLatestLimitedBy();
    }

}
