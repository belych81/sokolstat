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
    private $game;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalGame;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalGoal;

    /**
     * @ORM\Column(type="integer")
     */
    private $fnlGame;

    /**
     * @ORM\Column(type="integer")
     */
    private $fnlGoal;

    /**
     * @ORM\Column(type="integer")
     */
    private $sbGame;

    /**
     * @ORM\Column(type="integer")
     */
    private $sbGoal;

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

    public function getTotalGame(): ?int
    {
        return $this->totalGame;
    }

    public function setTotalGame(int $totalGame): self
    {
        $this->totalGame = $totalGame;

        return $this;
    }

    public function getTotalGoal(): ?int
    {
        return $this->totalGoal;
    }

    public function setTotalGoal(int $totalGoal): self
    {
        $this->totalGoal = $totalGoal;

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
