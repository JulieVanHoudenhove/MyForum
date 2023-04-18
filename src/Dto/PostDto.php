<?php

namespace App\Dto;

use App\Entity\User;
use Doctrine\ORM\PersistentCollection;

class PostDto
{
    public int $id;
    public string $title;
    public string $text;
    public User $user;
    public \DateTimeImmutable $date;
    public bool $isLiked;
    public int $likes;
    public PersistentCollection $comments;
}