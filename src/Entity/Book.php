<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Patch;
use App\Controller\BookController;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['getAuthor', 'getparent']]),
        new GetCollection(
            normalizationContext: ['groups' => ['getAuthor', 'getparent']]),
    ],
)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getAuthor"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getAuthor"])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getAuthor"])]
    private ?string $coverText = null;
    #[ORM\Column(length: 600, nullable: true)]
    #[Groups(["getAuthor"])]
    private ?string $Description = null;

    #[ORM\Column]
    #[Groups(["getAuthor"])]
    private ?int $stock = null;
    #[ORM\ManyToOne(inversedBy: 'Books')]
    #[Groups(["getparent"])]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCoverText(): ?string
    {
        return $this->coverText;
    }

    public function setCoverText(string $coverText): static
    {
        $this->coverText = $coverText;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
