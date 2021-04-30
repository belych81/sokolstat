<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RusplayerRepository")
 */
class Rusplayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="rusplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="integer")
     */
    private $game = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalgame = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalgoal = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $fnlgame = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $fnlgoal = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $sbgame = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $sbgoal = 0;

    private $gameTeam = 0;

    private $goalTeam = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ecgame = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ecgoal = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cupgame = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cupgoal = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $supercupgame;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $supercupgoal;

    public function setGameTeam(int $gameTeam)
    {
        $this->gameTeam = $gameTeam;

        return $this;
    }

    public function getGameTeam(): ?int
    {
        return $this->gameTeam;
    }

    public function setGoalTeam(int $goalTeam)
    {
        $this->goalTeam = $goalTeam;

        return $this;
    }

    public function getGoalTeam(): ?int
    {
        return $this->goalTeam;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotalgame(): ?int
    {
        return $this->totalgame;
    }

    public function setTotalgame(int $totalgame): self
    {
        $this->totalgame = $totalgame;

        return $this;
    }

    public function getTotalgoal(): ?int
    {
        return $this->totalgoal;
    }

    public function setTotalgoal(int $totalgoal): self
    {
        $this->totalgoal = $totalGoal;

        return $this;
    }

    public function getFnlgame(): ?int
    {
        return $this->fnlgame;
    }

    public function setFnlgame(int $fnlgame): self
    {
        $this->fnlgame = $fnlgame;

        return $this;
    }

    public function getFnlgoal(): ?int
    {
        return $this->fnlgoal;
    }

    public function setFnlgoal(int $fnlgoal): self
    {
        $this->fnlgoal = $fnlgoal;

        return $this;
    }

    public function getSbgame(): ?int
    {
        return $this->sbgame;
    }

    public function setSbgame(int $sbgame): self
    {
        $this->sbgame = $sbgame;

        return $this;
    }

    public function getSbgoal(): ?int
    {
        return $this->sbgoal;
    }

    public function setSbgoal(int $sbgoal): self
    {
        $this->sbgoal = $sbgoal;

        return $this;
    }

    public function getEcgame(): ?int
    {
        return $this->ecgame;
    }

    public function setEcgame(?int $ecgame): self
    {
        $this->ecgame = $ecgame;

        return $this;
    }

    public function getEcgoal(): ?int
    {
        return $this->ecgoal;
    }

    public function setEcgoal(?int $ecgoal): self
    {
        $this->ecgoal = $ecgoal;

        return $this;
    }

    public function getCupgame(): ?int
    {
        return $this->cupgame;
    }

    public function setCupgame(?int $cupgame): self
    {
        $this->cupgame = $cupgame;

        return $this;
    }

    public function getCupgoal(): ?int
    {
        return $this->cupgoal;
    }

    public function setCupgoal(?int $cupgoal): self
    {
        $this->cupgoal = $cupgoal;

        return $this;
    }

    public function getSupercupgame(): ?int
    {
        return $this->supercupgame;
    }

    public function setSupercupgame(?int $supercupgame): self
    {
        $this->supercupgame = $supercupgame;

        return $this;
    }

    public function getSupercupgoal(): ?int
    {
        return $this->supercupgoal;
    }

    public function setSupercupgoal(?int $supercupgoal): self
    {
        $this->supercupgoal = $supercupgoal;

        return $this;
    }
}
