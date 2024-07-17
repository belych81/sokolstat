<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\EctableRepository::class)]
class Ectable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Seasons::class, inversedBy: 'ectables')]
    private $season;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Team::class, inversedBy: 'ectables')]
    private $team;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Stadia::class, inversedBy: 'ectables')]
    private $stadia;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Turnir::class, inversedBy: 'ectables')]
    private $turnir;

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

    public function getStadia(): ?Stadia
    {
        return $this->stadia;
    }

    public function setStadia(?Stadia $stadia): self
    {
        $this->stadia = $stadia;

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
