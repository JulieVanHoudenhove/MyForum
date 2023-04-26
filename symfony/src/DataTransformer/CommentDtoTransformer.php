<?php

namespace App\DataTransformer;

use App\Dto\PostDto;
use App\Entity\User;
use App\Repository\LikedCommentRepository;

class CommentDtoTransformer
{
    private LikedCommentRepository $likedCommentRepository;

    public function __construct(LikedCommentRepository $likedCommentRepository)
    {
        $this->likedCommentRepository = $likedCommentRepository;
    }


    public function transform($comments, User $user): array
    {
        $dtos = [];
        foreach ($comments as $comment) {
            $like = $this->likedCommentRepository->findOneBy(['comment' => $comment, 'user' => $user]);

            $dto = new PostDto();
            $dto->id = $comment->getId();
            $dto->text = $comment->getText();
            $dto->updatedAt = $comment->getUpdatedAt();
            $dto->createdAt = $comment->getCreatedAt();
            $dto->user = $comment->getUser();
            $dto->likes = count($comment->getLikes());
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
}
