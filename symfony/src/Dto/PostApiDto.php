<?php

namespace App\Dto;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;
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
//    public Collection $comments;

    /**
     * @param int $id
     * @param string $title
     * @param string $text
     * @param string|null $image
     * @param User $user
     * @param \DateTime $createdAt
     * @param int $likes
     */
    public function __construct(int $id, string $title, string $text, User $user, \DateTime $createdAt, int $likes, ?string $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->user = $user;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
        $this->image = $image;
    }


}