<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlRegRepository")
 */
class NhlReg
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlSeason", inversedBy="nhlRegs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam", inversedBy="nhlRegs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlPlayer", inversedBy="nhlRegs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal;

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
}
