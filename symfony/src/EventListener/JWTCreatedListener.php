<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();

        $avatar = 'http://localhost:8000/uploads/avatars/' . $user->getAvatar();

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