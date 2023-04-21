<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'post:item']),
        new GetCollection(normalizationContext: ['groups' => 'post:list'])
    ],
    order: ['createdAt' => 'DESC'],
    paginationEnabled: true,
)]
class Post
{
    use TimestampableEntity;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['post:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['post:list'])]
    private ?string $title = null;

    #[ORM\Column(length: 180)]
    #[Groups(['post:list'])]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['post:list'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, cascade: ['persist', 'remove'])]
    #[Groups(['post:list'])]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: LikedPost::class, cascade: ['persist', 'remove'])]
    private Collection $likedPosts;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['post:list'])]
    private ?string $image = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likedPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

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

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LikedPost>
     */
    public function getLikedPosts(): Collection
    {
        return $this->likedPosts;
    }

    public function addLikedPost(LikedPost $likedPost): self
    {
        if (!$this->likedPosts->contains($likedPost)) {
            $this->likedPosts->add($likedPost);
            $likedPost->setPost($this);
        }

        return $this;
    }

    public function removeLikedPost(LikedPost $likedPost): self
    {
        if ($this->likedPosts->removeElement($likedPost)) {
            // set the owning side to null (unless already changed)
            if ($likedPost->getPost() === $this) {
                $likedPost->setPost(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    #[Groups(["post:list"])]
    #[SerializedName("createdAt")]
    public function getCreatedAtTimestampable(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
}
