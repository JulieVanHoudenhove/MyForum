<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Resource\Factory\ResourceMetadataCollectionFactoryInterface;
use ApiPlatform\State\ProviderInterface;
use App\DataTransformer\PostTransformer;
use App\Dto\PostApiDto;
use App\Entity\Post;

class PostCollectionProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $collectionProvider,  private PostTransformer $postTransformer)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $posts = $this->collectionProvider->provide($operation, $uriVariables, $context);
        $results = [];

        foreach ($posts as $post)
        {
            $results[] = $this->postTransformer->transform($post);
        }

        return $results;
    }
}
