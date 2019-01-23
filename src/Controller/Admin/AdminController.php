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

        //$offer1 = $offerRepository->findAllByDate();
        $offers = $offerRepository->findByLatestLimitedBy(5);
        $candidatures = $candidatureRepository->findByLatestLimitedBy(5);

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            //'offer1' => $offer1,
            'offers' => $offers,
            'candidatures' => $candidatures
        ]);
    }


}
