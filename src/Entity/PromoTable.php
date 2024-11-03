<?php

namespace App\Entity;

use App\Repository\PromoTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:PromoTableRepository::class)]
class PromoTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $marchand = null;

    #[ORM\Column(length: 50)]

    private ?string $code = null;
    #[ORM\Column(length: 1024)]

    private ?string $comment = null;

    #[ORM\Column(length: 1024)]

    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarchand(): ?string
    {
        return $this->marchand;
    }

    public function setMarchand(string $marchand): static
    {
        $this->marchand = $marchand;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
