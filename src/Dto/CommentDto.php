<?php

namespace App\Dto;

use App\Entity\User;

class CommentDto
{
    public int $id;
    public string $text;
    public User $user;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;
    public bool $isLiked;
    public int $likes;
}