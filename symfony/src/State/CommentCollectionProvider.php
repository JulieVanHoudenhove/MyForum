<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DataTransformer\CommentTransformer;

class CommentCollectionProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $collectionProvider,  private CommentTransformer $commentTransformer)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $comments = $this->collectionProvider->provide($operation, $uriVariables, $context);
        $results = [];

        foreach ($comments as $comment)
        {
            $results[] = $this->commentTransformer->transform($comment);
        }

        return $results;
    }
}
