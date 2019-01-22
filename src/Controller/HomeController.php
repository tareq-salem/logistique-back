<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\FullLocation;
use App\Utils\GeoLocation;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(FullLocation $fullLocation, GeoLocation $geoLoc)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController'
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation()
    {
        return $this->render('home/presentation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/references", name="references")
     */
    public function references()
    {
        return $this->render('home/references.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
