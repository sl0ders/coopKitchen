<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message:"comment.content.notBlank")]
    #[Assert\Length(min: 10, max: 1000, minMessage: "comment.content.min", maxMessage: "comment.content.max")]
    private ?string $content;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author;

    #[ORM\ManyToOne(targetEntity: Recipe::class, inversedBy: 'comments')]
    private ?Recipe $recipe;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'comments')]
    private ?Comment $commentChildren;

    #[ORM\OneToMany(mappedBy: 'commentChildren', targetEntity: self::class)]
    private ArrayCollection $comments;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isEnabled = true;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isParticipatory;

    #[Pure] public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getCommentChildren(): ?self
    {
        return $this->commentChildren;
    }

    public function setCommentChildren(?self $commentChildren): self
    {
        $this->commentChildren = $commentChildren;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(self $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCommentChildren($this);
        }

        return $this;
    }

    public function removeComment(self $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommentChildren() === $this) {
                $comment->setCommentChildren(null);
            }
        }

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getIsParticipatory(): ?bool
    {
        return $this->isParticipatory;
    }

    public function setIsParticipatory(bool $isParticipatory): self
    {
        $this->isParticipatory = $isParticipatory;

        return $this;
    }
}
