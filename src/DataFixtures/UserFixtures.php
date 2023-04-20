<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\LikedPost;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Ottaviano\Faker\Gravatar;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $hasher;
    public const USER_REFERENCE = 'user_';

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('fr_FR');
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
        $this->faker->addProvider(new Gravatar($this->faker));

        for ($i=1; $i < 11; $i++) {
            $avatar = $this->faker->gravatar('/var/www/myforum/public/uploads/avatars', 'retro');
            $avatar = explode('/', $avatar);

            $user = new User();
            $password = $this->hasher->hashPassword($user, '123456');
            $user->setUsername($this->faker->userName())
                ->setEmail($this->faker->safeEmail())
                ->setPassword($password)
                ->setAvatar($avatar[7]);
            $this->addReference(self::USER_REFERENCE.$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
