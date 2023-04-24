<?php

namespace App\DataFixtures;

use App\Entity\LikedComment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class LikedCommentFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 201; $i++) {
            $likedComment = new LikedComment();
            $date = $this->faker->dateTimeBetween('-4 week', 'now');
            $likedComment->setUser($this->getReference(UserFixtures::USER_REFERENCE.rand(1, 10)))
                ->setComment($this->getReference(CommentFixtures::COM_REFERENCE.rand(1, 200)))
                ->setCreatedAt($date)
                ->setUpdatedAt($date);
            $manager->persist($likedComment);
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [
            UserFixtures::class,
            PostFixtures::class,
            CommentFixtures::class
        ];
    }
}
