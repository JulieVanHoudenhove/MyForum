<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public const POST_REFERENCE = 'post_';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 101; $i++) {
            $post = new Post();
            $date = $this->faker->dateTimeBetween('-4 week', 'now');
            $post->setTitle($this->faker->realTextBetween(20, 50))
                ->setText($this->faker->realTextBetween(50, 180))
                ->setUser($this->getReference(UserFixtures::USER_REFERENCE  .rand(1, 10)))
                ->setCreatedAt($date)
                ->setUpdatedAt($date);
            $this->addReference(self::POST_REFERENCE.$i, $post);
            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [
            UserFixtures::class
        ];
    }
}
