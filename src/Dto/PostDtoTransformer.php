<?php

namespace App\Dto;

use App\Entity\Post;
use App\Entity\User;

class PostDtoTransformer
{
    public function transformFromObjects($posts, $user): array
    {
        $dtos = [];
        foreach ($posts as $post) {
            $likes = $post->getLikedPosts();

            $dto = new PostDto();
            $dto->id = $post->getId();
            $dto->title = $post->getTitle();
            $dto->text = $post->getText();
            $dto->date = $post->getDate();
            $dto->user = $post->getUser();
            $dto->likes = count($post->getLikedPosts());
            foreach ($likes as $like) {
                if ($like->getUser() == $user) {
                    $dto->isLiked = true;
                }
            }

            if (!isset($dto->isLiked)) {
                $dto->isLiked = false;
            }

            $dtos[] = $dto;
        }

        return $dtos;
    }

    public function transformFromObject($post, $user): PostDto
    {
        $likes = $post->getLikedPosts();
        $dto = new PostDto();
        $dto->id = $post->getId();
        $dto->title = $post->getTitle();
        $dto->text = $post->getText();
        $dto->date = $post->getDate();
        $dto->user = $post->getUser();
        $dto->likes = count($post->getLikedPosts());
        $dto->comments = $post->getComments();
        foreach ($likes as $like) {
            if ($like->getUser() == $user) {
                $dto->isLiked = true;
            }
        }

        if (!isset($dto->isLiked)) {
            $dto->isLiked = false;
        }

        return $dto;
    }
}
