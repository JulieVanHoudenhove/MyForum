<?php

namespace App\Entity;

use App\Entity\Trait\Timestamp;
use App\Repository\LikedPostRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: LikedPostRepository::class)]
#[ORM\HasLifecycleCallbacks]
class LikedPost
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'likedPosts')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'likedPosts')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
