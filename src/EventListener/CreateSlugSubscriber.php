<?php
/**
 * Created by PhpStorm.
 * User: adminHOC
 * Date: 23/01/2019
 * Time: 15:30
 */

namespace App\EventListener;

use App\Entity\LocationOffer;
use App\Entity\Offer;
use App\Repository\LocationOfferRepository;
use App\Repository\OfferRepository;
use Doctrine\Common\EventSubscriber;
//use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\Entity;

class CreateSlugSubscriber implements EventSubscriber
{
    //private $offerRepository;

    public function __construct()
    {
        //$this->offerRepository = $offerRepository;
    }

    /*
     * @return array des événements à surveiller
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::postPersist
        );
    }

    /**
     * Créé un slug à chaque création d'une offre
     * @param LocationOfferRepository $locationOfferRepository
     * @param LocationOffer $locationOffer
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        $offerRepository = $args->getEntityManager()->getRepository(Offer::class);

        if ($entity instanceof LocationOffer )
        {

            $offerRepository->createSlug($entity->getOffer());
        }
    }
}