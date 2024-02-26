<?php

namespace App\Entity;

use App\Repository\CarsTableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsTableRepository::class)
 */
class CarsTable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $plate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $registration;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $next_control;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $last_service_km;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $next_service;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $assurance;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $amount;


    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): self
    {
        $this->plate = $plate;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function setLogo(string $logo): self
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

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getRegistration(): ?\DateTimeInterface
    {
        return $this->registration;
    }

    public function setRegistration(?\DateTimeInterface $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getNextControl(): ?\DateTimeInterface
    {
        return $this->next_control;
    }

    public function setNextControl(?\DateTimeInterface $next_control): self
    {
        $this->next_control = $next_control;

        return $this;
    }

    public function getLastServiceKm(): ?int
    {
        return $this->last_service_km;
    }

    public function setLastServiceKm(int $last_service_km): self
    {
        $this->last_service_km = $last_service_km;

        return $this;
    }


    public function getNextService(): ?\DateTimeInterface
    {
        return $this->next_service;
    }

    public function setNextService(?\DateTimeInterface $next_service): self
    {
        $this->next_service = $next_service;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAssurance(): ?string
    {
        return $this->assurance;
    }

    public function setAssurance(string $assurance): self
    {
        $this->assurance = $assurance;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
