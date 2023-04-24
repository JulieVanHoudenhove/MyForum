<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DataTransformer\PostTransformer;
use App\Dto\PostApiDto;
use App\Entity\Post;

class PostItemProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $itemProvider,  private PostTransformer $postTransformer)
    {
    }

    /**
     * @param Post
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PostApiDto
    {
        $post = $this->itemProvider->provide($operation, $uriVariables, $context);
        return $this->postTransformer->transform($post);
    }
}
