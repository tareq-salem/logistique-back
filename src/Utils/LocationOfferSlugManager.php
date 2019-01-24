<?php
namespace App\Utils;

use App\Entity\LocationOffer;
use App\Entity\ContractType;
use App\Repository\LocationOfferRepository;

class LocationOfferSlugManager
{
    private $slugger;
    const URL_PREFIX = 'logisticc-recrute-';

    public function __construct(Slugger $slugger)
    {
        $this->slugger = $slugger;
    }

    public function setSlug(LocationOffer $locationOffer)
    {
        $titreOffre = $locationOffer->getOffer()->getTitle();
        $typeContrat = $locationOffer->getOffer()->getContratType()->getName();
        $typeOffre = $locationOffer->getOffer()->getOfferType()->getName();
        $codePostal = $locationOffer->getLocation()->getPostalCode();
        $ville = $locationOffer->getLocation()->getCity();

        $locationOffer->setSlug(
            $this->slugger->slugify(
                implode("-", [
                    self::URL_PREFIX,
                    $titreOffre,
                    $typeContrat,
                    $typeOffre,
                    $codePostal,
                    $ville
                ])
            )
        );
    }

    // public function updateContractTypeSlug(ContractType $contractType)
    // {
    //     // $offer = $offerRepository->findOneBy($entity);
    //     // $locationOffer = $offer->getLocationOffer();
    //     // $offerRepository->createSlug($entity->getOffer());
    //     $locationOffer = new LocationOfferRepository();
    // }
}