<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\NhlRegRepository::class)]
class NhlReg
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Seasons::class, inversedBy: 'nhlRegs')]
    private $season;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\NhlTeam::class, inversedBy: 'nhlRegs')]
    private $team;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Entity\NhlPlayer::class, inversedBy: 'nhlRegs')]
    private $player;

    #[ORM\Column(type: 'integer')]
    private $goal = 0;

    #[ORM\Column(type: 'integer')]
    private $assist = 0;

    #[ORM\Column(type: 'integer')]
    private $score = 0;

    #[ORM\Column(type: 'integer')]
    private $game = 0;

    #[ORM\Column(type: 'integer')]
    private $missed = 0;

    #[ORM\Column(type: 'integer')]
    private $zero = 0;

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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

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

    public function getMissed(): ?int
    {
        return $this->missed;
    }

    public function setMissed(int $missed): self
    {
        $this->missed = $missed;

        return $this;
    }

    public function getZero(): ?int
    {
        return $this->zero;
    }

    public function setZero(int $zero): self
    {
        $this->zero = $zero;

        return $this;
    }

    private $gameTeam;

    private $missedTeam;

    private $zeroTeam;

    private $goalTeam;

    private $assistTeam;

    private $scoreTeam;

    #[ORM\Column(type: 'integer')]
    private $gamePlayOff = 0;

    #[ORM\Column(type: 'integer')]
    private $gameSum = 0;

    #[ORM\Column(type: 'integer')]
    private $goalPlayOff = 0;

    #[ORM\Column(type: 'integer')]
    private $goalSum = 0;

    #[ORM\Column(type: 'integer')]
    private $assistPlayOff = 0;

    #[ORM\Column(type: 'integer')]
    private $assistSum = 0;

    #[ORM\Column(type: 'integer')]
    private $scorePlayOff = 0;

    #[ORM\Column(type: 'integer')]
    private $scoreSum = 0;

    #[ORM\Column(type: 'integer')]
    private $missedPlayOff = 0;

    #[ORM\Column(type: 'integer')]
    private $missedSum = 0;

    #[ORM\Column(type: 'integer')]
    private $zeroPlayOff = 0;

    #[ORM\Column(type: 'integer')]
    private $zeroSum = 0;

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

    public function setAssistTeam($assistTeam)
    {
        $this->assistTeam = $assistTeam;

        return $this;
    }

    public function getAssistTeam()
    {
        return $this->assistTeam;
    }

    public function setScoreTeam($scoreTeam)
    {
        $this->scoreTeam = $scoreTeam;

        return $this;
    }

    public function getScoreTeam()
    {
        return $this->scoreTeam;
    }

    public function setZeroTeam($zeroTeam)
    {
        $this->zeroTeam = $zeroTeam;

        return $this;
    }

    public function getZeroTeam()
    {
        return $this->zeroTeam;
    }

    public function setMissedTeam($missedTeam)
    {
        $this->missedTeam = $missedTeam;

        return $this;
    }

    public function getMissedTeam()
    {
        return $this->missedTeam;
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
