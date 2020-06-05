<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Review;
use APP\Repository\RestaurantRepository;
use APP\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index", methods={"GET"})
     */
    public function index()
    {
        $restaurantRepository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaurant = $restaurantRepository->findLastCreatedRestaurants(10);
        
        return $this->render('app/index.html.twig', [ 'restaurants' => $restaurant]);
    }
}
