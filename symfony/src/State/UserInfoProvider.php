<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Service\UploaderService;

class UserInfoProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $collectionProvider, private UploaderService $uploaderService)
    {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $users = $this->collectionProvider->provide($operation, $uriVariables, $context);

        foreach ($users as $user)
        {
            $url = $this->uploaderService->getUrl($user->getAvatar(), $this->uploaderService::AVATAR);
            $user->setAvatar($url);
            $user->setUidd('/api/users/'.$user->getId());
        }

        return $users;
    }
}
