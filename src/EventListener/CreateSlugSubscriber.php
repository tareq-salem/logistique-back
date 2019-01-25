<?php
namespace App\EventListener;

use App\Entity\LocationOffer;
use App\Entity\Offer;
use App\Repository\LocationOfferRepository;
use App\Repository\OfferRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\Entity;
use App\Utils\LocationOfferSlugManager;
use App\Entity\ContractType;
use App\Entity\OfferType;
use phpDocumentor\Reflection\Location;

class CreateSlugSubscriber implements EventSubscriber
{
    private $slugManager;

    public function __construct(LocationOfferSlugManager $slugManager)
    {
        $this->slugManager = $slugManager;
    }

    /*
     * @return array des événements à surveiller
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate
        );
    }

    /**
     * Créé un slug à chaque création d'une offre
     * @param LocationOfferRepository $locationOfferRepository
     * @param LocationOffer $locationOffer
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $offerRepository = $args->getEntityManager()->getRepository(Offer::class);

        if ( $entity instanceof Offer)
        {
            $locationOffers = $entity->getLocationOffers();
            foreach ($locationOffers as $locationOffer)
            {
                $this->slugManager->setSlug($locationOffer);
            }
            // $this->slugManager->setSlug($entity);
        }
    }

    /**
     * Créé un slug à chaque création d'une offre
     * @param LocationOfferRepository $locationOfferRepository
     * @param LocationOffer $locationOffer
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        
        if ($entity instanceof ContractType || $entity instanceof OfferType)
        {
            
            $offers = $entity->getOffers();
            foreach ($offers as $offer)
            {
                $locationOffers = $offer->getLocationOffers();

                foreach ($locationOffers as $locationOffer)
                {
                    $this->slugManager->setSlug($locationOffer);
                }
            }

        }

        if ($entity instanceof Location || $entity instanceof Offer)
        {
            $locationOffers = $entity->getLocationOffers();
            foreach ($locationOffers as $locationOffer)
            {
                $this->slugManager->setSlug($locationOffer);
            }
        }
    }
}