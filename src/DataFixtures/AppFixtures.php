<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\LikedPost;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $manager->flush();
    }
}