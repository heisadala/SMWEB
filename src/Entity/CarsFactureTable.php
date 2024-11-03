<?php

namespace App\Entity;

use App\Repository\CarsFactureTableRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass:CarsFactureTableRepository::class)]
class CarsFactureTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]

    private ?string $plate = null;

    #[ORM\Column(length: 50)]

    private ?string $model = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]

    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50)]

    private $garage = null;

    #[ORM\Column(length: 50)]

    private $city = null;

    #[ORM\Column]

    private ?int $km = null;

    #[ORM\Column(length: 200)]

    private $comment = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]

    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getGarage(): ?string
    {
        return $this->garage;
    }

    public function setGarage(string $garage): static
    {
        $this->garage = $garage;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): static
    {
        $this->km = $km;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
}
