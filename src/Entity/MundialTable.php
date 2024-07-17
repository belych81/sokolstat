<?php

namespace App\Entity;

use App\Repository\MundialTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\MundialTableRepository::class)]
class MundialTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $year;

    #[ORM\ManyToOne(targetEntity: Turnir::class, inversedBy: 'mundialTables')]
    private $turnir;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'mundialTables')]
    private $country;

    #[ORM\Column(type: 'integer')]
    private $wins = 0;

    #[ORM\Column(type: 'integer')]
    private $nich = 0;

    #[ORM\Column(type: 'integer')]
    private $porazh = 0;

    #[ORM\Column(type: 'integer')]
    private $mz = 0;

    #[ORM\Column(type: 'integer')]
    private $mp = 0;

    #[ORM\Column(type: 'integer')]
    private $score = 0;

    #[ORM\Column(type: 'integer')]
    private $seat = 1;

    #[ORM\ManyToOne(targetEntity: Stadia::class, inversedBy: 'mundialTables')]
    private $stadia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getTurnir(): ?Turnir
    {
        return $this->turnir;
    }

    public function setTurnir(?Turnir $turnir): self
    {
        $this->turnir = $turnir;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getNich(): ?int
    {
        return $this->nich;
    }

    public function setNich(int $nich): self
    {
        $this->nich = $nich;

        return $this;
    }

    public function getPorazh(): ?int
    {
        return $this->porazh;
    }

    public function setPorazh(int $porazh): self
    {
        $this->porazh = $porazh;

        return $this;
    }

    public function getMz(): ?int
    {
        return $this->mz;
    }

    public function setMz(int $mz): self
    {
        $this->mz = $mz;

        return $this;
    }

    public function getMp(): ?int
    {
        return $this->mp;
    }

    public function setMp(int $mp): self
    {
        $this->mp = $mp;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getSeat(): ?int
    {
        return $this->seat;
    }

    public function setSeat(int $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getStadia(): ?Stadia
    {
        return $this->stadia;
    }

    public function setStadia(?Stadia $stadia): self
    {
        $this->stadia = $stadia;

        return $this;
    }

    public function __toString()
    {
      return (string)$this->getCountry()->getName();
    }
}
