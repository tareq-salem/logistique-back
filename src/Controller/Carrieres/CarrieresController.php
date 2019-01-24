<?php

    namespace App\Controller\Carrieres;

    use App\Entity\LocationOffer;
    use App\Entity\Offer;
    use App\Form\PostulerType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class CarrieresController extends AbstractController
    {
        /**
         * @Route("/carrieres", name="carrieres")
         */
        public function index()
        {
            return $this->render('carrieres/index.html.twig', [
                'controller_name' => 'CarrieresController',
            ]);
        }

        /**
         * candidature spontannee
         * @Route("/carrieres/postuler", name="postuler")
         */
        public function postuler(Request $request)
        {

            $form = $this->createForm(PostulerType::class);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                /*
                 * Retourner un message de Bon sumit
                return $this->redirectToRoute('postuler');
                */
            }

                //enregstrer des donnés du fomr
                //->flush
            return $this->render('carrieres/postuler/index.html.twig', [
                'controller_name' => 'CarrieresController',
                'form' => $form->createView(),

            ]);
        }

        /**
         * @Route("/carrieres/offres", name="offres")
         */
        public function offres()
        {
            return $this->render('carrieres/offer/index.html.twig', [
                'controller_name' => 'CarrieresController',
            ]);
        }

        ////////////////////////////////////////// TODO

        /**
         * @Route("/carrieres/offre/{offerSlug}", name="offre")
         */
        public function offre(Request $resquest, Offer $offer, LocationOffer $locationOffer): Response
        {

            $offerSlug = $locationOffer->getSlug();

            return $this->render('carrieres/offre/index.html.twig', [
                'controller_name' => 'CarrieresController',
                'offer' => $offer,
                'slug'=> $offerSlug
            ]);
        }

        public function minou()
        {
            return $this->render('carrieres/offre/index.html.twig', [
                'controller_name' => 'CarrieresController',
            ]);
        }
    }
