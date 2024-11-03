<?php

namespace App\Entity;

use App\Repository\GiftsUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:GiftsUserRepository::class)]
class GiftsUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]

    private ?string $name = null;
    #[ORM\Column(length: 20, nullable: true)]

    private ?string $table_name = null;

    #[ORM\Column(length: 20, nullable: true)]

    private ?string $icon = null;

    #[ORM\Column(length: 20, nullable: true)]

    private ?string $background = null;

    #[ORM\Column(length: 50, nullable: true)]

    private ?string $url = null;

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

    public function getDbName(): ?string
    {
        return $this->table_name;
    }

    public function setDbName(?string $table_name): static
    {
        $this->table_name = $table_name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): static
    {
        $this->background = $background;

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

    public function getTableName(): ?string
    {
        return $this->table_name;
    }

    public function setTableName(?string $table_name): static
    {
        $this->table_name = $table_name;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
