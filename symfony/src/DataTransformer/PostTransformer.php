<?php

namespace App\DataTransformer;

use App\Dto\PostApiDto;
use App\Dto\PostApiDtoUser;
use App\Entity\Post;
use App\Repository\LikedPostRepository;
use App\Repository\UserRepository;
use App\Service\UploaderService;

class PostTransformer
{

    public function __construct(private UploaderService $uploaderService, private LikedPostRepository $likedPostRepository,
                                private UserRepository $userRepository)
    {
    }

    public function transform(Post $post): PostApiDto
    {
        $url = $this->uploaderService->getUrl($post->getImage(), $this->uploaderService::POST);

        $dto = new PostApiDto(
            $post->getId(),
            $post->getTitle(),
            $post->getText(),
            $post->getUser(),
           $post->getCreatedAt(),
            count($post->getLikes()),
            $url,
            null,
            null
        );

        return $dto;
    }

    public function transformUser(Post $post, $userId): PostApiDto
    {
        $url = $this->uploaderService->getUrl($post->getImage(), $this->uploaderService::POST);
        $user = $this->userRepository->findOneBy(['id' => $userId]);

        if ($liked = $this->likedPostRepository->findOneBy(['post' => $post, 'user' => $user ])) {
            $isLiked = true;
        } else {
            $isLiked = null;
        }

        $dto = new PostApiDto(
            $post->getId(),
            $post->getTitle(),
            $post->getText(),
            $post->getUser(),
            $post->getCreatedAt(),
            count($post->getLikes()),
            $url,
            $isLiked,
            $liked?->getId()
        );

        return $dto;
    }
}
