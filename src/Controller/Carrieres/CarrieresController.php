<?php

    namespace App\Controller\Carrieres;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;

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
            $form = $this->createForm(CandidatureType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // Logique création candidature & candidat
                // Utilisation des repository concernés
                // Enregistrement des entités, liaison candidature/candidat, upload des fichiers...
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('candidature_index', [
                    'id' => $candidature->getId(),
                ]);
            }

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
         * @Route("/carrieres/offre/{slug}", name="offre")
         */
        public function offre()
        {
            return $this->render('carrieres/offre/index.html.twig', [
                'controller_name' => 'CarrieresController',
            ]);
        }
    }
