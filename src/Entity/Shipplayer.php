<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipplayerRepository")
 */
class Shipplayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="shipplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="shipplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="shipplayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $cup = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $supercup = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $eurocup = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $sum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $game;

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

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getCup(): ?int
    {
        return $this->cup;
    }

    public function setCup(int $cup): self
    {
        $this->cup = $cup;

        return $this;
    }

    public function getSupercup(): ?int
    {
        return $this->supercup;
    }

    public function setSupercup(int $supercup): self
    {
        $this->supercup = $supercup;

        return $this;
    }

    public function getEurocup(): ?int
    {
        return $this->eurocup;
    }

    public function setEurocup(int $eurocup): self
    {
        $this->eurocup = $eurocup;

        return $this;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function setSum(int $sum): self
    {
        $this->sum = $sum;

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

    public function getcompetition()
    {
      return $this->getTeam()->getCountry()->getName().' (чемпионат)';
    }
}
