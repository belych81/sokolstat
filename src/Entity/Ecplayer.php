<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcplayerRepository")
 */
class Ecplayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="ecplayers")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="ecplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="ecplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turnir", inversedBy="ecplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turnir;

    /**
     * @ORM\Column(type="integer")
     */
    private $game = 1;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal = 0;

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

    public function getTurnir(): ?Turnir
    {
        return $this->turnir;
    }

    public function setTurnir(?Turnir $turnir): self
    {
        $this->turnir = $turnir;

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

    private $gameTeam;

    private $goalTeam;

    public function setGameTeam(int $gameTeam): self
    {
        $this->gameTeam = $gameTeam;

        return $this;
    }


    public function getGameTeam(): ?int
    {
        return $this->gameTeam;
    }

    public function setGoalTeam(int $goalTeam): self
    {
        $this->goalTeam = $goalTeam;

        return $this;
    }

    public function getGoalTeam(): ?int
    {
        return $this->goalTeam;
    }

    public function getcompetition()
    {
      return 'Еврокубки ('.$this->getTurnir()->getName().')';
    }
}
