<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\NhlPlayOffRepository::class)]
class NhlPlayOff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\NhlSeason::class, inversedBy: 'nhlPlayOffs')]
    private $season;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\NhlTeam::class, inversedBy: 'nhlPlayOffs')]
    private $team;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\NhlPlayer::class, inversedBy: 'nhlPlayOffs')]
    private $player;

    #[ORM\Column(type: 'integer')]
    private $goal;

    #[ORM\Column(type: 'integer')]
    private $assist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?NhlSeason
    {
        return $this->season;
    }

    public function setSeason(?NhlSeason $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getTeam(): ?NhlTeam
    {
        return $this->team;
    }

    public function setTeam(?NhlTeam $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getPlayer(): ?NhlPlayer
    {
        return $this->player;
    }

    public function setPlayer(?NhlPlayer $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getAssist(): ?int
    {
        return $this->assist;
    }

    public function setAssist(int $assist): self
    {
        $this->assist = $assist;

        return $this;
    }
}
