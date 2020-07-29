<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewspaperRepository")
 */
class Newspaper
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
    private $mainphoto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainphototext;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainphoto(): ?string
    {
        return $this->mainphoto;
    }

    public function setMainphoto(string $mainphoto): self
    {
        $this->mainphoto = $mainphoto;

        return $this;
    }

    public function getMainphototext(): ?string
    {
        return $this->mainphototext;
    }

    public function setMainphototext(string $mainphototext): self
    {
        $this->mainphototext = $mainphototext;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
