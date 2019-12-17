<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlPlayersTeamRepository")
 */
class NhlPlayersTeam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlPlayer", inversedBy="nhlPlayersTeams")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam", inversedBy="nhlPlayersTeams")
     */
    private $team;

    /**
     * @ORM\Column(type="integer")
     */
    private $gameReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $gamePlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $gameSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $assistReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $assistPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $assistSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $scoreReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $scorePlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $scoreSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $missedReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $missedPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $missedSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $zeroReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $zeroPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $zeroSum = 0;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeam(): ?NhlTeam
    {
        return $this->team;
    }

    public function setTeam(?NhlTeam $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getGameReg(): ?int
    {
        return $this->gameReg;
    }

    public function setGameReg(int $gameReg): self
    {
        $this->gameReg = $gameReg;

        return $this;
    }

    public function getGamePlayOff(): ?int
    {
        return $this->gamePlayOff;
    }

    public function setGamePlayOff(int $gamePlayOff): self
    {
        $this->gamePlayOff = $gamePlayOff;

        return $this;
    }

    public function getGameSum(): ?int
    {
        return $this->gameSum;
    }

    public function setGameSum(int $gameSum): self
    {
        $this->gameSum = $gameSum;

        return $this;
    }

    public function getGoalReg(): ?int
    {
        return $this->goalReg;
    }

    public function setGoalReg(int $goalReg): self
    {
        $this->goalReg = $goalReg;

        return $this;
    }

    public function getGoalPlayOff(): ?int
    {
        return $this->goalPlayOff;
    }

    public function setGoalPlayOff(int $goalPlayOff): self
    {
        $this->goalPlayOff = $goalPlayOff;

        return $this;
    }

    public function getGoalSum(): ?int
    {
        return $this->goalSum;
    }

    public function setGoalSum(int $goalSum): self
    {
        $this->goalSum = $goalSum;

        return $this;
    }

    public function getAssistReg(): ?int
    {
        return $this->assistReg;
    }

    public function setAssistReg(int $assistReg): self
    {
        $this->assistReg = $assistReg;

        return $this;
    }

    public function getAssistPlayOff(): ?int
    {
        return $this->assistPlayOff;
    }

    public function setAssistPlayOff(int $assistPlayOff): self
    {
        $this->assistPlayOff = $assistPlayOff;

        return $this;
    }

    public function getAssistSum(): ?int
    {
        return $this->assistSum;
    }

    public function setAssistSum(int $assistSum): self
    {
        $this->assistSum = $assistSum;

        return $this;
    }

    public function getScoreReg(): ?int
    {
        return $this->scoreReg;
    }

    public function setScoreReg(int $scoreReg): self
    {
        $this->scoreReg = $scoreReg;

        return $this;
    }

    public function getScorePlayOff(): ?int
    {
        return $this->scorePlayOff;
    }

    public function setScorePlayOff(int $scorePlayOff): self
    {
        $this->scorePlayOff = $scorePlayOff;

        return $this;
    }

    public function getScoreSum(): ?int
    {
        return $this->scoreSum;
    }

    public function setScoreSum(int $scoreSum): self
    {
        $this->scoreSum = $scoreSum;

        return $this;
    }

    public function getMissedReg(): ?int
    {
        return $this->missedReg;
    }

    public function setMissedReg(int $missedReg): self
    {
        $this->missedReg = $missedReg;

        return $this;
    }

    public function getMissedPlayOff(): ?int
    {
        return $this->missedPlayOff;
    }

    public function setMissedPlayOff(int $missedPlayOff): self
    {
        $this->missedPlayOff = $missedPlayOff;

        return $this;
    }

    public function getMissedSum(): ?int
    {
        return $this->missedSum;
    }

    public function setMissedSum(int $missedSum): self
    {
        $this->missedSum = $missedSum;

        return $this;
    }

    public function getZeroReg(): ?int
    {
        return $this->zeroReg;
    }

    public function setZeroReg(int $zeroReg): self
    {
        $this->zeroReg = $zeroReg;

        return $this;
    }

    public function getZeroPlayOff(): ?int
    {
        return $this->zeroPlayOff;
    }

    public function setZeroPlayOff(int $zeroPlayOff): self
    {
        $this->zeroPlayOff = $zeroPlayOff;

        return $this;
    }

    public function getZeroSum(): ?int
    {
        return $this->zeroSum;
    }

    public function setZeroSum(int $zeroSum): self
    {
        $this->zeroSum = $zeroSum;

        return $this;
    }
}
