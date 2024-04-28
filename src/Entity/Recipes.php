<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;


    #[ORM\ManyToOne(inversedBy: 'recipes')]
    private ?RecipesType $relation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recipes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): static
    {
        $this->illustration = $illustration;

        return $this;
    }



    public function getRelation(): ?RecipesType
    {
        return $this->relation;
    }

    public function setRelation(?RecipesType $relation): static
    {
        $this->relation = $relation;

        return $this;
    }

    public function getRecipes(): ?string
    {
        return $this->recipes;
    }

    public function setRecipes(string $recipes): static
    {
        $this->recipes = $recipes;

        return $this;
    }
}
