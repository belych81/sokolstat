<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\ShiptableRepository::class)]
class Shiptable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Seasons::class, inversedBy: 'shiptables')]
    private $season;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Team::class, inversedBy: 'shiptables')]
    private $team;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Country::class, inversedBy: 'shiptables')]
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?Seasons
    {
        return $this->season;
    }

    public function setSeason(?Seasons $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

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

    public function __toString()
    {
        return (string)$this->id;
    }
}
