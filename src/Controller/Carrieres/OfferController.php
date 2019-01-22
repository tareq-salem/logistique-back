<?php
/**
 * Created by PhpStorm.
 * User: adminHOC
 * Date: 22/01/2019
 * Time: 11:56
 */

namespace App\Controller\Carrieres;

use App\Entity\LocationOffer;
use App\Repository\LocationOfferRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Offer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{

    /**
     * @Route("/carrieres/offres", name="offres")
     */
    public function index(OfferRepository $offerRepository)
    {
        $offres = $offerRepository->findByLatestLimitedBy(5);

        return $this->render('carrieres/offres/index.html.twig', [
            'controller_name' => 'OfferController',
            'offres' => $offres
        ]);
    }

    /**
     * @Route("/carrieres/offres/{slug}", name="offreDetail")
     */
    public function showSingleOffer(LocationOfferRepository $slug,
                                    OfferRepository $offerRepository)
    {
//        try {
            $offerRepository->findOneBySlug($slug);
//        }
//        catch () {
//
//        }

    }



}