<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Migrations\Version\Factory as VersionFactory;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ReviewFixtures extends Fixture implements FixtureGroupInterface
{
    private $restaurantRepository;
    private $reviewRepository;

    public function __construct(RestaurantRepository $restaurantRepository, ReviewRepository $reviewRepository, UserRepository $userRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
        $this->reviewRepository = $reviewRepository;
        $this->userRepository = $userRepository;
    }

public static function getGroups(): array
{
    return ['group1'];
}

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        /**
         * On va créer 7000 reviews initiales
         */

        $rand = rand(1,10);

        $restaurant = $this->restaurantRepository->find(1);
        $user = $this->userRepository->find(rand(1,10));

        if ($restaurant == null) {
            dd($rand);
        }
        for ($i = 0; $i <= 700; $i++) {
            $review = new Review();
            $review->setMessage($faker->text(800));
            $review->setRating(rand(0, 5));
            $review->setRestaurant($restaurant);
            $review->setUser($user);
            $manager->persist($review);
        }

        /**
         * On les enregistre en DB
         */
        $manager->flush();

        /**
         * On crée 3000 avis enfants dont le parents est une review initiales)
         */

        $review = $this->reviewRepository->find(rand(1,7000));
        $user = $this->userRepository->find(rand(1,10));
        
        for ($i = 0; $i <= 3000; $i++) {
            $review = new Review();
            $review->setMessage($faker->text(800));
            $review->setRating(rand(0, 5));
            $review->setParent($review);
            $review->setRestaurant($review->getParent()->getRestaurant());
            $review->setUser($user);
            $manager->persist($review);
        }

        /**
         * On les enregistre en DB
         */
        $manager->flush();
    }

    // public function getDependencies()
    // {
    //     return array(
    //         RestaurantFixtures::class,
    //     );
    // }
}
