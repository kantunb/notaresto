<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    // /**
    //  * @Route("/new", name="restaurant_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $restaurant = new Restaurant();
    //     $form = $this->createForm(RestaurantType::class, $restaurant);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($restaurant);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('restaurant_index');
    //     }

    //     return $this->render('restaurant/new.html.twig', [
    //         'restaurant' => $restaurant,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="restaurant_show", methods={"GET"})
    //  */
    // public function show(Restaurant $restaurant): Response
    // {
    //     return $this->render('restaurant/show.html.twig', [
    //         'restaurant' => $restaurant,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="restaurant_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, Restaurant $restaurant): Response
    // {
    //     $form = $this->createForm(RestaurantType::class, $restaurant);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('restaurant_index');
    //     }

    //     return $this->render('restaurant/edit.html.twig', [
    //         'restaurant' => $restaurant,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="restaurant_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Restaurant $restaurant): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($restaurant);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('restaurant_index');
    // }
}