<?php

namespace App\DataTransformer;

use App\Dto\PostApiDto;
use App\Entity\Post;

class PostTransformer
{
    public function transform(Post $post): PostApiDto
    {
        $dto = new PostApiDto(
            $post->getId(),
            $post->getTitle(),
            $post->getText(),
            $post->getUser(),
            $post->getCreatedAt(),
            count($post->getLikes()),
            $post->getImage(),
        );

        return $dto;
    }
}
