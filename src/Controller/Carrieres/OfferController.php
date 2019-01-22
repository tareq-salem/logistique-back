<?php
/**
 * Created by PhpStorm.
 * User: adminHOC
 * Date: 22/01/2019
 * Time: 11:56
 */

namespace App\Controller\Carrieres;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Offer;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{

    /**
     * @Route("/carrieres/offers", name="offers")
     */
    public function index(OfferRepository $offerRepository)
    {
        $offers = $offerRepository->findByLatestLimitedBy(5);

        return $this->render('carrieres/offres/index.html.twig', [
            'controller_name' => 'OfferController',
            'offers' => $offers
        ]);
    }



}