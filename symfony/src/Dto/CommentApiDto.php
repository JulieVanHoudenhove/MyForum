<?php

namespace App\Dto;

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

//    public bool $isLiked;

    /**
     * @param int $id
     * @param string $text
     * @param User $user
     * @param \DateTime $createdAt
     * @param int $likes
     */
    public function __construct(int $id, string $text, User $user, \DateTime $createdAt, int $likes)
    {
        $this->id = $id;
        $this->text = $text;
        $this->user = $user;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
    }


}