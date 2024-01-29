<?php

namespace App\Entity;

use App\Repository\GiftsTableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GiftsTableRepository::class)
 */
class GiftsTable
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
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $gift;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $url;
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $archive;
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $userlist;


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

    public function setGift(?string $gift): self
    {
        $this->gift = $gift;

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
    
    public function getArchive(): ?string
    {
        return $this->archive;
    }

    public function setArchive(string $archive): self
    {
        $this->archive = $archive;

        return $this;
    }
public function getUserlist(): ?string
    {
        return $this->userlist;
    }

    public function setUserlist(string $userlist): self
    {
        $this->userlist = $userlist;

        return $this;
    }
}
