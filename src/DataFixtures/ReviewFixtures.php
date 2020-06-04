<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Migrations\Version\Factory as VersionFactory;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    private $restaurantRepository;
    private $reviewRepository;

    public function __construct(RestaurantRepository $restaurantRepository, ReviewRepository $reviewRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        /**
         * On va créer 7000 reviews initiales
         */

        $restaurant = $this->restaurantRepository->find(rand(1,1000));

        for ($i = 0; $i <= 7000; $i++) {
            $review = new Review();
            $review->setMessage($faker->text(800));
            $review->setRating(rand(0, 5));
            $review->setRestaurant($restaurant);
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
        
        for ($i = 0; $i <= 3000; $i++) {
            $review = new Review();
            $review->setMessage($faker->text(800));
            $review->setRating(rand(0, 5));
            $review->setParent($review);
            $review->setRestaurant($review->getParent()->getRestaurant());
            $manager->persist($review);
        }

        /**
         * On les enregistre en DB
         */
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            RestaurantFixtures::class,
        );
    }
}
