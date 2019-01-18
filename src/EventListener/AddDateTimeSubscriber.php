<?php

namespace App\EventListener;

use App\Entity\SuperClass;
use Doctrine\ORM\Events;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

class AddDateTimeSubscriber implements EventSubscriber
{
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
     * Enregistre un timestamp dans created_at et modified_at à chaque création de champs dans la BDD
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $currentDate = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        if ($entity instanceof SuperClass)
        {
            $entity->setModifiedAt($currentDate);

            if ($entity->getCreatedAt() === null) {
                $entity->setCreatedAt($currentDate);
            }
        }
    }

    /**
     * Met à jour le timestamp dans modified_at à chaque mise à jour de champs dans la BDD
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $currentDate = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        if ($entity instanceof SuperClass)
        {
            $entity->setModifiedAt($currentDate);
        }
    }
}