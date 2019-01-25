<?php

namespace App\Controller\Carrieres;

use App\Entity\Offer;
use App\Entity\LocationOffer;
use App\Form\OfferType;
use App\Repository\LocationOfferRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carrieres/offres")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="offres")
     */
    public function index(OfferRepository $offerRepository): Response
    {
        $offres = $offerRepository->findAllActualActive();
        //var_dump($offres);
        return $this->render('carrieres/offer/index.html.twig', [
            'controller_name' => 'OfferController',
            'offres' => $offres
        ]);
    }

    /**
     * @Route("/{slug}", name="offreDetail", methods={"GET"})
     */
    public function show(LocationOffer $locationOffer): Response
    {
        return $this->render('carrieres/offer/show.html.twig', [
            'locationOffer' => $locationOffer,
        ]);
    }
}
