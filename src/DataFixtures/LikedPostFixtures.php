<?php

namespace App\DataFixtures;

use App\Entity\LikedPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LikedPostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 41; $i++) {
            $likedPost = new LikedPost();
            $likedPost->setUser($this->getReference(UserFixtures::USER_REFERENCE.rand(1, 10)))
                ->setPost($this->getReference(PostFixtures::POST_REFERENCE.rand(1, 20)));
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
