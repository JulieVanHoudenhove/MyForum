<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\LikedPost;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Ottaviano\Faker\Gravatar;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('fr_FR');
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
        $this->faker->addProvider(new Gravatar($this->faker));

        $this->addUsers($manager);
        $this->addPosts($manager);
        $this->addComments($manager);
        $this->addPostLikes($manager);

        $manager->flush();
    }

    private function addUsers(EntityManager $em) {
        for ($i=1; $i < 11; $i++) {
            $user = new User();
            $user->setUsername($this->faker->userName);
            $password = $this->hasher->hashPassword($user, '123456');
            $avatar = $this->faker->gravatar('/var/www/myforum/public/uploads/avatars', 'retro');
            $avatar = explode('/', $avatar);
            $user->setPassword($password)
                ->setAvatar($avatar[7]);
            $this->addReference("user_".$i, $user);
            $em->persist($user);
        }
    }

    private function addPosts(EntityManager $em) {
        for ($i=1; $i < 21; $i++) {
            $post = new Post();
            $createdDate = $this->faker->dateTimeBetween('-2 week', 'now');
            $post->setTitle($this->faker->sentence(3))
                ->setText($this->faker->realTextBetween(50, 120))
                ->setUser($this->getReference("user_".rand(1, 10)))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($createdDate));
            $this->addReference('post_'.$i, $post);
            $em->persist($post);
        }
    }

    private function addComments(EntityManager $em) {
        for ($i=1; $i < 31; $i++) {
            $comment = new Comment();
            $comment->setText($this->faker->realTextBetween(20, 40))
                ->setUser($this->getReference("user_".rand(1, 10)))
                ->setPost($this->getReference("post_".rand(1, 20)));
            $em->persist($comment);
        }
    }

    private function addPostLikes(EntityManager $em) {
        for ($i=1; $i < 41; $i++) {
            $likedPost = new LikedPost();
            $likedPost->setUser($this->getReference("user_".rand(1, 10)))
                ->setPost($this->getReference("post_".rand(1, 20)));
            $em->persist($likedPost);
        }
    }
}
