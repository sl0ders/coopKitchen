<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'integer')]
    private ?int $quantity;

    #[ORM\Column(type: 'string', length: 10)]
    private ?string $unity;

    #[ORM\OneToOne(mappedBy: 'ingredient', targetEntity: Picture::class, cascade: ['persist', 'remove'])]
    private ?Picture $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnity(): ?string
    {
        return $this->unity;
    }

    public function setUnity(string $unity): self
    {
        $this->unity = $unity;

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        // unset the owning side of the relation if necessary
        if ($picture === null && $this->picture !== null) {
            $this->picture->setIngredient(null);
        }

        // set the owning side of the relation if necessary
        if ($picture !== null && $picture->getIngredient() !== $this) {
            $picture->setIngredient($this);
        }

        $this->picture = $picture;

        return $this;
    }
}
