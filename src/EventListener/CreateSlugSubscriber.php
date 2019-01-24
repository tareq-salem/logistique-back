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

        if ($entity instanceof LocationOffer)
        {
            //$offerRepository->createSlug($entity->getOffer());
            $this->slugManager->setSlug($entity);
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

        $offerRepository = $args->getEntityManager()->getRepository(Offer::class);
        $offer = $offerRepository->findOneBy( $entity);

        $locationOfferRepository = $args->getEntityManager()->getRepository(LocationOffer::class);
        $locationOffer = $locationOfferRepository->findOneBy($offer);


        if ($entity instanceof ContractType)
        {
            $this->slugManager->setSlug($locationOffer);
        }
    }
}