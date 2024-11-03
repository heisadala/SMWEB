<?php

namespace App\Entity;

use App\Repository\CarsTableRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass:CarsTableRepository::class)]
class CarsTable
{
    #[ORM\Id]
    #[ORM\Column]
    private ?string $plate = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $brand;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $logo;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $model;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $registration = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $next_control = null;

    #[ORM\Column(length: 6, nullable: false)]
    private ?int $last_service_km = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $next_service = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $assurance = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $amount = null;


    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): static
    {
        $this->plate = $plate;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }
    public function getLogo(): ?string
    {
        return $this->logo;
    }


    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getRegistration(): ?\DateTimeInterface
    {
        return $this->registration;
    }

    public function setRegistration(?\DateTimeInterface $registration): static
    {
        $this->registration = $registration;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getNextControl(): ?\DateTimeInterface
    {
        return $this->next_control;
    }

    public function setNextControl(?\DateTimeInterface $next_control): static
    {
        $this->next_control = $next_control;

        return $this;
    }

    public function getLastServiceKm(): ?int
    {
        return $this->last_service_km;
    }

    public function setLastServiceKm(int $last_service_km): static
    {
        $this->last_service_km = $last_service_km;

        return $this;
    }


    public function getNextService(): ?\DateTimeInterface
    {
        return $this->next_service;
    }

    public function setNextService(?\DateTimeInterface $next_service): static
    {
        $this->next_service = $next_service;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAssurance(): ?string
    {
        return $this->assurance;
    }

    public function setAssurance(string $assurance): static
    {
        $this->assurance = $assurance;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
