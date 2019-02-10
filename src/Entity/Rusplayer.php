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
    private $fnlGame = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $fnlGoal = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $sbGame = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $sbGoal = 0;

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

    public function getFnlGame(): ?int
    {
        return $this->fnlGame;
    }

    public function setFnlGame(int $fnlGame): self
    {
        $this->fnlGame = $fnlGame;

        return $this;
    }

    public function getFnlGoal(): ?int
    {
        return $this->fnlGoal;
    }

    public function setFnlGoal(int $fnlGoal): self
    {
        $this->fnlGoal = $fnlGoal;

        return $this;
    }

    public function getSbGame(): ?int
    {
        return $this->sbGame;
    }

    public function setSbGame(int $sbGame): self
    {
        $this->sbGame = $sbGame;

        return $this;
    }

    public function getSbGoal(): ?int
    {
        return $this->sbGoal;
    }

    public function setSbGoal(int $sbGoal): self
    {
        $this->sbGoal = $sbGoal;

        return $this;
    }
}
