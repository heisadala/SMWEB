<?php

namespace App\Entity;

use App\Repository\LegoTableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LegoTableRepository::class)
 */
class LegoTable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $theme;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $cond;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $url;

    public function getReference(): ?int
    {
        return $this->reference;
    }
    public function setReference(int $reference): self
    {
        $this->reference = $reference;
        return $this;

    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCond(): ?string
    {
        return $this->cond;
    }

    public function setCond(?string $cond): self
    {
        $this->cond = $cond;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
