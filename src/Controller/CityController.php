<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/city_index", name="city_index")
     */
    public function index()
    {
        return $this->render('city/index.html.twig', [
            'controller_name' => 'CityController',
        ]);
    }
}
