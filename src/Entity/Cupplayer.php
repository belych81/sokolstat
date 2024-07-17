<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\CupplayerRepository::class)]
class Cupplayer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Seasons::class, inversedBy: 'cupplayers')]
    private $season;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Team::class, inversedBy: 'cupplayers')]
    private $team;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Player::class, inversedBy: 'cupplayers')]
    private $player;

    #[ORM\Column(type: 'integer')]
    private $game = 1;

    #[ORM\Column(type: 'integer')]
    private $goal = 0;

    private $gameTeam = 0;

    private $goalTeam = 0;

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

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(int $game): self
    {
        $this->game = $game;

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

    public function setGameTeam($gameTeam)
    {
        $this->gameTeam = $gameTeam;

        return $this;
    }

    public function getGameTeam()
    {
        return $this->gameTeam;
    }

    public function setGoalTeam($goalTeam)
    {
        $this->goalTeam = $goalTeam;

        return $this;
    }

    public function getGoalTeam()
    {
        return $this->goalTeam;
    }

    public function getcompetition()
    {
      return 'Кубок России';
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}
