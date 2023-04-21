<?php

namespace Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testLoginPost(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['id' => 1]);

        $client->loginUser($testUser);

        $client->request('GET', '/post/new');

        $client->submitForm('Create', [
            'post[title]' => 'Test1234',
            'post[text]' => '123456',
        ]);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $client->request('GET', '/post/1');

        $this->assertSelectorTextContains('h2', 'Tempore quia quos.');
    }
}
