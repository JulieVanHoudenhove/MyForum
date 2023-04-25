<?php

namespace App\DataTransformer;

use App\Dto\CommentApiDto;
use App\Entity\Comment;

class CommentTransformer
{
    public function transform(Comment $comment): CommentApiDto
    {
        $dto = new CommentApiDto(
            $comment->getId(),
            $comment->getText(),
            $comment->getUser(),
            $comment->getCreatedAt(),
            count($comment->getLikes()),
            $comment->getPost()
        );

        return $dto;
    }
}
