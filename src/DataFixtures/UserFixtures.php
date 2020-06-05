<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;


class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getGroups(): array
    {
    return ['group1'];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        //Create Owner
        for ($i=0; $i < 100; $i++) { 
            $userOwner = new User();
            $userOwner->setEmail( $faker->unique()->email );
            $userOwner->setRoles( ['ROLE_OWNER'] );
            $userOwner->setPassword($this->encoder->encodePassword($userOwner, 'azerty'));
            $userOwner->setIsVerified('1');
    
            $manager->persist($userOwner);
            }

        $manager->flush();
    }
}
