<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\EurocupRepository::class)]
class Eurocup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Seasons::class, inversedBy: 'eurocups')]
    private $season;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Team::class, inversedBy: 'eurocups')]
    private $team;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Team::class, inversedBy: 'eurocups')]
    private $team2;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Stadia::class, inversedBy: 'eurocups')]
    private $stadia;

    #[ORM\Column(type: 'string', length: 255)]
    private $score = "0-0";

    #[ORM\Column(type: 'string', length: 255)]
    private $bomb = "-";

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Turnir::class, inversedBy: 'eurocups')]
    private $turnir;

    private $route = 'eurocup';

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

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(?string $route): self
    {
        $this->route = $route;

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

    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    public function setTeam2(?Team $team2): self
    {
        $this->team2 = $team2;

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

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getBomb(): ?string
    {
        return $this->bomb;
    }

    public function setBomb(string $bomb): self
    {
        $this->bomb = $bomb;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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

    #[ORM\OneToOne(targetEntity: \App\Entity\Ecsostav::class, mappedBy: 'eurocup')]
    private $ecsostav;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $number;

    public function setEcsostav(?Ecsostav $ecsostav = null): self
    {
        $this->ecsostav = $ecsostav;

        return $this;
    }

    public function getEcsostav(): ?Ecsostav
    {
        return $this->ecsostav;
    }

    public function __toString()
    {
      return (string)$this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

  }
