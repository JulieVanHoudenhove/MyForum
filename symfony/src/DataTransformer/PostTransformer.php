<?php

namespace App\DataTransformer;

use App\Dto\PostApiDto;
use App\Dto\PostApiDtoUser;
use App\Entity\Post;
use App\Repository\LikedPostRepository;
use App\Repository\UserRepository;

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
