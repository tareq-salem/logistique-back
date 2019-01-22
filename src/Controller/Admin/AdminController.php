<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use App\Repository\CandidateRepository;
use App\Repository\CandidatureRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * DASHBOARD
     * @Route("/admin", name="admin")
     */
    public function index(OfferRepository $offerRepository, CandidatureRepository $candidatureRepository)
    {

       // * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
/*
        $offers = $offerRepository->findBy([
            ["created_at"],
            ["ASC"],
            5,
            null
            ]);

        $candidatures = $candidatureRepository->findBy([
            ["created_at"],
            ["ASC"],
            5,
            null
            ]);
*/

        $offers = $offerRepository->findByLatestLimitedBy(null);
        $candidatures = $candidatureRepository->findByLatestLimitedBy(5);

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'offers' => $offers,
            'candidatures' => $candidatures
        ]);
    }


}
