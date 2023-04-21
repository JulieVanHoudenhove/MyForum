<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\PostApiDto;
use App\Entity\Post;

class PostItemProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $itemProvider)
    {
    }

    /**
     * @param Post
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PostApiDto
    {
        $post = $this->itemProvider->provide($operation, $uriVariables, $context);
        return new PostApiDto(
            $post->getId(),
            $post->getTitle(),
            $post->getText(),
            $post->getUser(),
            $post->getCreatedAt(),
            count($post->getLikes()),
            $post->getImage(),
        );
    }
}
