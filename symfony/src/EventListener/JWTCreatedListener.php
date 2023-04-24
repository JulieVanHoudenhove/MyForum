<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function __construct(private $avatarDirectory)
    {
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();

        $avatar = 'http://localhost:8088/myforum/uploads/avatars/' . $user->getAvatar();

        $payload = array_merge(
            $event->getData(),
            [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'avatar' => $avatar
            ]
        );

        $event->setData($payload);
    }
}