<?php

namespace App\DataFixtures;

use App\Entity\LikedPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class LikedPostFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 201; $i++) {
            $likedPost = new LikedPost();
            $date = $this->faker->dateTimeBetween('-4 week', 'now');
            $likedPost->setUser($this->getReference(UserFixtures::USER_REFERENCE.rand(1, 10)))
                ->setPost($this->getReference(PostFixtures::POST_REFERENCE.rand(1, 100)))
                ->setCreatedAt($date)
                ->setUpdatedAt($date);
            $manager->persist($likedPost);
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}
