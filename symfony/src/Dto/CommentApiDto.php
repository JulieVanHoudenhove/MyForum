<?php

namespace App\Dto;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;

class CommentApiDto
{
    #[Groups(['comment:list'])]
    public int $id;

    #[Groups(['comment:list'])]
    public string $text;

    #[Groups(['comment:list'])]
    public User $user;

    #[Groups(['comment:list'])]
    public \DateTime $createdAt;

    #[Groups(['comment:list'])]
    public int $likes;

    #[Groups(['comment:list'])]
    public Post $post;

    #[Groups(['comment:list'])]
    public ?bool $isLiked;

    #[Groups(['comment:list'])]
    public ?int $likeId;


    public function __construct(int $id, string $text, User $user, \DateTime $createdAt, int $likes, Post $post, ?bool $isLiked, ?int $likeId)
    {
        $this->id = $id;
        $this->text = $text;
        $this->user = $user;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
        $this->post = $post;
        $this->isLiked = $isLiked;
        $this->likeId = $likeId;
    }
}