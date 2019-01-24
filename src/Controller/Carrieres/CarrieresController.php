<?php

    namespace App\Controller\Carrieres;

    use App\Entity\Candidate;
    use App\Entity\Candidature;
    use App\Entity\LocationOffer;
    use App\Entity\Offer;
    use App\Form\PostulerType;
    use App\Repository\CandidateRepository;
    use App\Repository\CandidatureRepository;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\EntityManagerInterface;
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
        public function postuler(Request $request, EntityManagerInterface $em, CandidatureRepository $candidatureRepository, CandidateRepository $candidateRepository)
        {
            // Enregistrement des entités, liaison candidature/candidat, upload des fichiers...
            // Utilisation des repository concernés
            // Logique création candidature & candidat
            $form = $this->createForm(PostulerType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $postuler = $form->getData();
                var_dump($postuler);

                $candidate = $candidateRepository->insertNewCandidate(
                    $postuler['firstname'],
                    $postuler['lastname'],
                    $postuler['email']
                );

                $em->persist($candidate);
                $candidature = $candidatureRepository->insertNewCandidature(
                    $postuler['message'],
                    $postuler['cv'],
                    $postuler['lm'],
                    $candidate
                );

                $em->persist($candidature);

                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                $em->flush();
                $this->addFlash('success',
                    $postuler['firstname']. ' '.$postuler['lastname']. ' '.'Candidature envoyé créée!!');



                $this->getDoctrine()->getManager()->flush();

                //Retourner un message de Bon sumit
                return $this->redirectToRoute('postuler');

            }
            return $this->render('carrieres/postuler/index.html.twig', [
                'controller_name' => 'CarrieresController',
                'form' => $form->createView(),
            ]);
        }


        public function createAdminFromCommand($login, $password){

            $role [] =  "ROLE_ADMIN";
            $admin = new User();
            $adminLn = count($this->findAll());
            if($adminLn < 1) {
                $admin->setLogin($login);
                $admin->setPassword($this->passwordEncoder->encodePassword($admin, $password));
                $admin->setRoles($role);
                $this->getEntityManager()->persist($admin);
                $this->getEntityManager()->flush();
            }else{
                throw new \RuntimeException("Vous ne pouvez pas rajouter un user \n
            pour remplacer l'utilisateur,  veuillez vous connecter à phpmyadmin et le supprimer\n
            puis rejouez la commande");
            }
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
        //public function offre(Offer $offer): Response
        public function offre(Request $resquest, Offer $offer, LocationOffer $locationOffer, EntityManager $em): Response
        {


           $offerSlug = $locationOffer->getSlug();
                //$lo = $resquest->query->get('slug');

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
