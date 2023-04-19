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
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;
    public bool $isLiked;
    public int $likes;
    public Collection $comments;
}