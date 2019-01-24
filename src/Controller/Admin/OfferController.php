<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\LocationOfferRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("admin/offres")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="admin_offer_index", methods={"GET"})
     */
    public function index(OfferRepository $offerRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // $offers = $offerRepository->findAll();
        $offers = $paginator->paginate(
            $offerRepository->findAllVisible(),
            $request->query->getInt('page', 1)
       );

        return $this->render('admin/offer/index.html.twig', [
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/new", name="admin_offer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('admin_offer_index');
        }

        return $this->render('admin/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="admin_offer_show", methods={"GET"})
     */
    public function show(Offer $offer): Response
    {
        return $this->render('admin/offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="admin_offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offer $offer): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_offer_index', [
                'id' => $offer->getId(),
            ]);
        }

        return $this->render('admin/offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="admin_offer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offer $offer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_offer_index');
    }
}
