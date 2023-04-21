<?php

namespace App\Dto;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class PostDto
{
    public int $id;
    public string $title;
    public string $text;
    public ?string $image = null;
    public User $user;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public bool $isLiked;
    public int $likes;
    public Collection $comments;
}