<?php

namespace App\EventListener;

use App\Service\UploaderService;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function __construct()
    {
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();

        $avatar = 'http://localhost:8088/myforum/uploads/avatars/'.$user->getAvatar();

        $payload = array_merge(
            $event->getData(),
            [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'avatar' => $avatar,
                '@id' => '/api/users/'.$user->getId()
            ]
        );

        $event->setData($payload);
    }
}