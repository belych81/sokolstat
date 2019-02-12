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
}
