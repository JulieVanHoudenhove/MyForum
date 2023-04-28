<?php

namespace App\DataTransformer;

use App\Dto\CommentApiDto;
use App\Entity\Comment;
use App\Repository\LikedCommentRepository;
use App\Repository\UserRepository;

class CommentTransformer
{
    public function __construct(private LikedCommentRepository $likedCommentRepository, private UserRepository $userRepository)
    {
    }

    public function transform(Comment $comment): CommentApiDto
    {
        $dto = new CommentApiDto(
            $comment->getId(),
            $comment->getText(),
            $comment->getUser(),
            $comment->getCreatedAt(),
            count($comment->getLikes()),
            $comment->getPost(),
            null,
            null
        );

        return $dto;
    }

    public function transformUser(Comment $comment, int $userId): CommentApiDto
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);

        if ($liked = $this->likedCommentRepository->findOneBy(['comment' => $comment, 'user' => $user ])) {
            $isLiked = true;
        } else {
            $isLiked = null;
        }


        $dto = new CommentApiDto(
            $comment->getId(),
            $comment->getText(),
            $comment->getUser(),
            $comment->getCreatedAt(),
            count($comment->getLikes()),
            $comment->getPost(),
            $isLiked,
            $liked?->getId()
        );

        return $dto;
    }
}
