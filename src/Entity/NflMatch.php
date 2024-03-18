<?php

namespace App\Entity;

use App\Repository\NflMatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NflMatchRepository")
 */
class NflMatch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam", inversedBy="nflMatches")
     */
    private $team = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team2 = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="nflMatches")
     */
    private ?Seasons $season = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $status = false;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeam2(): ?NhlTeam
    {
        return $this->team2;
    }

    public function setTeam2(?NhlTeam $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }


    public function getSeason(): ?Seasons
    {
        return $this->season;
    }

    public function setSeason(?Seasons $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }
}
