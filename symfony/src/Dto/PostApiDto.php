<?php

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;

class PostApiDto
{
    #[Groups(['post:list', 'post:item'])]
    public int $id;
    #[Groups(['post:list', 'post:item'])]
    public string $title;
    #[Groups(['post:list', 'post:item'])]
    public string $text;
    #[Groups(['post:list', 'post:item'])]
    public User $user;
    #[Groups(['post:list', 'post:item'])]
    public \DateTime $createdAt;
    #[Groups(['post:list', 'post:item'])]
    public int $likes;
    #[Groups(['post:list', 'post:item'])]
    public ?string $image = null;
    #[Groups(['post:list', 'post:item'])]
    public ?bool $isLiked = null;
    #[Groups(['post:list', 'post:item'])]
    public ?int $likeId = null;

    public function __construct(int $id, string $title, string $text, User $user, \DateTime $createdAt, int $likes, ?string $image, ?bool $isLiked, ?int $likeId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->user = $user;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
        $this->image = $image;
        $this->isLiked = $isLiked;
        $this->likeId = $likeId;
    }





}