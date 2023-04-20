<?php

namespace Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostLimitControllerTest extends WebTestCase
{
    public function testLoginPost(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['id' => 1]);

        $client->loginUser($testUser);

        $client->request('GET', '/post/new');

        $client->submitForm('Create', [
            'post[title]' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Ae',
            'post[text]' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
             commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
             dis parturient montes, nascetur ridiculus mus. Donec qu',
        ]);

        // Error because post title limit 50 chars / post text limit 180 chars
        $this->assertResponseStatusCodeSame(500);
    }
}
