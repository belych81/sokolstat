<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlTableRepository")
 */
class NhlTable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="nhlTables")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam", inversedBy="nhlTables")
     */
    private $team;

    /**
     * @ORM\Column(type="integer")
     */
    private $wins = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $nich = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $porazh = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $mz = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $mp = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $score = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlDivision", inversedBy="nhlTables")
     */
    private $division;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $winst = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $porazht = 0;

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

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getNich(): ?int
    {
        return $this->nich;
    }

    public function setNich(int $nich): self
    {
        $this->nich = $nich;

        return $this;
    }

    public function getPorazh(): ?int
    {
        return $this->porazh;
    }

    public function setPorazh(int $porazh): self
    {
        $this->porazh = $porazh;

        return $this;
    }

    public function getMz(): ?int
    {
        return $this->mz;
    }

    public function setMz(int $mz): self
    {
        $this->mz = $mz;

        return $this;
    }

    public function getMp(): ?int
    {
        return $this->mp;
    }

    public function setMp(int $mp): self
    {
        $this->mp = $mp;

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

    public function getDivision(): ?NhlDivision
    {
        return $this->division;
    }

    public function setDivision(?NhlDivision $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getWinst(): ?int
    {
        return $this->winst;
    }

    public function setWinst(?int $winst): static
    {
        $this->winst = $winst;

        return $this;
    }

    public function getPorazht(): ?int
    {
        return $this->porazht;
    }

    public function setPorazht(?int $porazht): static
    {
        $this->porazht = $porazht;

        return $this;
    }
}
