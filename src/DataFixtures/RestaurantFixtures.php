<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Repository\CityRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Migrations\Version\Factory as VersionFactory;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RestaurantFixtures extends Fixture implements FixtureGroupInterface
{
    private $cityRepository;
    private $userRepository;

    public function __construct(CityRepository $cityRepository, UserRepository $userRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
    }

    public static function getGroups(): array
    {
        return ['group4'];
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i < 1000; $i++) {

            $city = $this->cityRepository->find(rand(1, 1000));
            $user = $this->userRepository->find(rand(1,10));

            $restaurant = new Restaurant();
            $restaurant->setName( $faker->company );
            $restaurant->setDescription( $faker->realtext(500) );
            $restaurant->setCity($city);
            $restaurant->setUser($user);

            $manager->persist($restaurant);
        }

        
        $manager->flush();
    }

    // public function getDependencies()
    // {
    //     return [
    //         CityFixtures::class,
    //         UserFixtures::class,
    //     ];
    // }
}
