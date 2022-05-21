<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $url;

    #[ORM\Column(type: 'string', length: 10)]
    private ?string $extension;

    #[ORM\ManyToOne(targetEntity: Recipe::class, inversedBy: 'pictures')]
    private ?Recipe $recipe;

    #[ORM\OneToOne(inversedBy: 'picture', targetEntity: Ingredient::class, cascade: ['persist', 'remove'])]
    private ?Ingredient $ingredient;

    #[ORM\OneToOne(inversedBy: 'picture', targetEntity: user::class, cascade: ['persist', 'remove'])]
    private ?user $avatar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

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

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getAvatar(): ?user
    {
        return $this->avatar;
    }

    public function setAvatar(?user $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
