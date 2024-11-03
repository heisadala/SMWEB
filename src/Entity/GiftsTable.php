<?php

namespace App\Entity;

use App\Repository\GiftsTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:GiftsTableRepository::class)]
class GiftsTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]

    private ?string $name = null;

    #[ORM\Column(length: 1024, nullable: true)]

    private ?string $gift = null;

    #[ORM\Column(length: 1024, nullable: true)]

    private ?string $url = null;
    #[ORM\Column(length: 10, nullable: true)]

    private ?string $archive = null;

    #[ORM\Column(length: 10, nullable: true)]

    private ?string $userlist = null;


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

    public function getGift(): ?string
    {
        return $this->gift;
    }

    public function setGift(?string $gift): static
    {
        $this->gift = $gift;

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
    
    public function getArchive(): ?string
    {
        return $this->archive;
    }

    public function setArchive(string $archive): static
    {
        $this->archive = $archive;

        return $this;
    }
public function getUserlist(): ?string
    {
        return $this->userlist;
    }

    public function setUserlist(string $userlist): static
    {
        $this->userlist = $userlist;

        return $this;
    }
}
