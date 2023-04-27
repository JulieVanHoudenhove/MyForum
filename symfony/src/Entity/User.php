<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post as Poster;
use ApiPlatform\Metadata\Put;
use App\Controller\UploadImageController;
use App\Repository\UserRepository;
use App\State\UserChangeAvatarProcessor;
use App\State\UserChangePasswordProcessor;
use App\State\UserRegisterProcessor;
use App\State\UserStatsProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => 'user:item']
        ),
        new Get(
            uriTemplate: '/user_stats/{id}',
            normalizationContext: ['groups' => 'user:stats'],
            provider: UserStatsProvider::class
        ),
        new Poster(
            uriTemplate: '/register/',
            denormalizationContext: ['groups' => 'user:register'],
            processor: UserRegisterProcessor::class
        ),
        new Put(
            uriTemplate: '/change-password/{id}',
            denormalizationContext: ['groups' => 'user:changePassword'],
            processor: UserChangePasswordProcessor::class
        ),
        new GetCollection(),
        new Poster(
            uriTemplate: '/change-avatar/{id}',
            inputFormats: ['multipart' => ['multipart/form-data']],
            controller: UploadImageController::class,
            normalizationContext: ['groups' => 'user:avatar-read'],
            denormalizationContext: ['groups' => 'user:avatar'],
            deserialize: false
        )
        ],
    paginationEnabled: false,
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['post:list', 'post:item', 'user:item', 'comment:list', 'user:stats', 'user:register'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['post:list', 'post:item', 'user:item', 'comment:list', 'user:stats', 'user:register'])]
    private ?string $username = null;

    #[ORM\Column]
    #[Groups(['user:register'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Post::class)]
    #[Groups(['user:stats'])]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: LikedPost::class)]
    private Collection $likedPosts;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: LikedComment::class)]
    private Collection $likedComments;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:item', 'user:register', 'user:avatar-read'])]
    private ?string $avatar = 'default-pp.png';

    #[ORM\Column(length: 255)]
    #[Groups(['user:item', 'user:register'])]
    private ?string $email = null;

    #[Groups(['user:register', 'user:changePassword'])]
    #[SerializedName('password')]
    private ?string $plainPassword = null;

    #[Groups(['user:changePassword'])]
    #[SerializedName('currentPassword')]
    private ?string $currentPassword = null;

    #[Groups(['user:avatar'])]
    #[SerializedName('file')]
    private ?UploadedFile $file = null;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->likedPosts = new ArrayCollection();
        $this->likedComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
        $this->currentPassword = null;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
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
            $likedPost->setUser($this);
        }

        return $this;
    }

    public function removeLikedPost(LikedPost $likedPost): self
    {
        if ($this->likedPosts->removeElement($likedPost)) {
            // set the owning side to null (unless already changed)
            if ($likedPost->getUser() === $this) {
                $likedPost->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LikedComment>
     */
    public function getLikedComments(): Collection
    {
        return $this->likedComments;
    }

    public function addLikedComment(LikedComment $likedComment): self
    {
        if (!$this->likedComments->contains($likedComment)) {
            $this->likedComments->add($likedComment);
            $likedComment->setUser($this);
        }

        return $this;
    }

    public function removeLikedComment(LikedComment $likedComment): self
    {
        if ($this->likedComments->removeElement($likedComment)) {
            // set the owning side to null (unless already changed)
            if ($likedComment->getUser() === $this) {
                $likedComment->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getCurrentPassword(): ?string
    {
        return $this->currentPassword;
    }

    public function setCurrentPassword(?string $currentPassword): void
    {
        $this->currentPassword = $currentPassword;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;
    }



}
