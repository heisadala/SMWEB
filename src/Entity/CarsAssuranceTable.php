<?php

namespace App\Entity;

use App\Repository\CarsAssuranceTableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsAssuranceTableRepository::class)
 */
class CarsAssuranceTable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $plate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $insurance;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $rate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $drivers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): self
    {
        $this->plate = $plate;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getInsurance(): ?string
    {
        return $this->insurance;
    }

    public function setInsurance(string $insurance): self
    {
        $this->insurance = $insurance;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getDrivers(): ?string
    {
        return $this->drivers;
    }

    public function setDrivers(string $drivers): self
    {
        $this->drivers = $drivers;

        return $this;
    }
}
