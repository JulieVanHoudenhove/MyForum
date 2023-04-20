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
        for ($i=1; $i < 21; $i++) {
            $post = new Post();
            $createdDate = $this->faker->dateTimeBetween('-2 week', 'now');
            $post->setTitle($this->faker->sentence(3))
                ->setText($this->faker->realTextBetween(50, 120))
                ->setUser($this->getReference(UserFixtures::USER_REFERENCE  .rand(1, 10)))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($createdDate));
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
