<?php

namespace App\Dto;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\LikedPostRepository;

class PostDtoTransformer
{
    private LikedPostRepository $likedPostRepository;

    /**
     * @param LikedPostRepository $likedPostRepository
     */
    public function __construct(LikedPostRepository $likedPostRepository)
    {
        $this->likedPostRepository = $likedPostRepository;
    }


    public function transformFromObjects($posts, User $user): array
    {
        $dtos = [];
        foreach ($posts as $post) {
            $like = $this->likedPostRepository->findOneBy(['post' => $post, 'user' => $user]);

            $dto = new PostDto();
            $dto->id = $post->getId();
            $dto->title = $post->getTitle();
            $dto->text = $post->getText();

            if ($post->getImage() != null) {
                $dto->image = $post->getImage();
            }

            $dto->updatedAt = $post->getUpdatedAt();
            $dto->createdAt = $post->getCreatedAt();
            $dto->user = $post->getUser();
            $dto->likes = count($post->getLikedPosts());
            if ($like) {
                $dto->isLiked = true;
            }

            if (!isset($dto->isLiked)) {
                $dto->isLiked = false;
            }

            $dtos[] = $dto;
        }

        return $dtos;
    }

    public function transformFromObject(Post $post, User $user): PostDto
    {
        $like = $this->likedPostRepository->findOneBy(['post' => $post, 'user' => $user]);
        $dto = new PostDto();
        $dto->id = $post->getId();
        $dto->title = $post->getTitle();
        $dto->text = $post->getText();

        if ($post->getImage() != null) {
            $dto->image = $post->getImage();
        }

        $dto->updatedAt = $post->getUpdatedAt();
        $dto->createdAt = $post->getCreatedAt();
        $dto->user = $post->getUser();
        $dto->likes = count($post->getLikedPosts());
        $dto->comments = $post->getComments();

        if ($like) {
            $dto->isLiked = true;
        }

        if (!isset($dto->isLiked)) {
            $dto->isLiked = false;
        }

        return $dto;
    }


//    public function transformFromObject(Post $post, User $user): PostDto
//    {
//        $likes = $post->getLikedPosts();
//        $dto = new PostDto();
//        $dto->id = $post->getId();
//        $dto->title = $post->getTitle();
//        $dto->text = $post->getText();
//        $dto->date = $post->getDate();
//        $dto->user = $post->getUser();
//        $dto->likes = count($post->getLikedPosts());
//        $dto->comments = $post->getComments();
//        foreach ($likes as $like) {
//            if ($like->getUser() == $user) {
//                $dto->isLiked = true;
//            }
//        }
//
//        if (!isset($dto->isLiked)) {
//            $dto->isLiked = false;
//        }
//
//        return $dto;
//    }
}
