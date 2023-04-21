<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 201; $i++) {
            $comment = new Comment();
            $date = $this->faker->dateTimeBetween('-4 week', 'now');
            $comment->setText($this->faker->realTextBetween(20, 40))
                ->setUser($this->getReference(UserFixtures::USER_REFERENCE.rand(1, 10)))
                ->setPost($this->getReference(PostFixtures::POST_REFERENCE.rand(1, 100)))
                ->setCreatedAt($date)
                ->setUpdatedAt($date);
            $manager->persist($comment);
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