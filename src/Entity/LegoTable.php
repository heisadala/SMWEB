<?php

namespace App\Entity;

use App\Repository\LegoTableRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass:LegoTableRepository::class)]
class LegoTable
{
    #[ORM\Id]
    #[ORM\Column]

    private ?int $reference = null;

    #[ORM\Column(length: 128, nullable: true)]

    private ?string $name = null;

    #[ORM\Column(length: 128, nullable: true)]

    private ?string $theme = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2, nullable: true)]

    private ?string $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]

    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 30, nullable: true)]

    private ?string $state = null;

    #[ORM\Column(length: 512, nullable: true)]

    private ?string $url = null;

    public function getReference(): ?int
    {
        return $this->reference;
    }
    public function setReference(int $reference): static
    {
        $this->reference = $reference;
        return $this;

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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
