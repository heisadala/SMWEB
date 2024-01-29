<?php

namespace App\Entity;

use App\Repository\GiftsUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GiftsUserRepository::class)
 */
class GiftsUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;
   /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $table_name;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $url;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDbName(): ?string
    {
        return $this->table_name;
    }

    public function setDbName(?string $table_name): self
    {
        $this->table_name = $table_name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

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

    public function getTableName(): ?string
    {
        return $this->table_name;
    }

    public function setTableName(?string $table_name): self
    {
        $this->table_name = $table_name;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
