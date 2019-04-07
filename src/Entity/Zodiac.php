<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZodiacRepository")
 */
class Zodiac
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $period;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $character;

    /**
     * @ORM\Column(type="text")
     */
    private $health;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $common;

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

    public function getPeriod(): ?\DateInterval
    {
        return $this->period;
    }

    public function setPeriod(\DateInterval $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    public function setCharacter(string $character): self
    {
        $this->character = $character;

        return $this;
    }

    public function getHealth(): ?string
    {
        return $this->health;
    }

    public function setHealth(string $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getCommon(): ?string
    {
        return $this->common;
    }

    public function setCommon(?string $common): self
    {
        $this->common = $common;

        return $this;
    }
}
