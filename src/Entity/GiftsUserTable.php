<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GiftsUserTableRepository;

/**
 * @ORM\Entity(repositoryClass=GiftsUserTableRepository::class)
 */
class GiftsUserTable
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
    private $name;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $gift;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $url;
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $archive;

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

    public function getGift(): ?string
    {
        return $this->gift;
    }

    public function setGift(string $gift): self
    {
        $this->gift = $gift;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
    public function getArchive(): ?string
    {
        return $this->archive;
    }

    public function setArchive(string $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function copy_gifts_table(GiftsTable $giftsTable, bool $id = true) :self
    {
        if ($id) {
            $this->id = $giftsTable->getId();
        }
        $this->name = $giftsTable->getName();
        $this->gift = $giftsTable->getGift();
        $this->url = $giftsTable->getUrl();
        $this->archive = $giftsTable->getArchive();

        return $this;

    }
}
