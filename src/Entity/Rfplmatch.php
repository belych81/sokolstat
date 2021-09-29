<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RfplmatchRepository")
 */
class Rfplmatch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="rfplmatches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="rfplmatches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="rfplmatches")
     */
    private $team2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="rfplmatches")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="rfplmatches")
     */
    private $player2;

    /**
     * @ORM\Column(type="integer")
     */
    private $tour;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal1 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal2 = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bomb = "-";

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    private $route = 'championships';

    private $country = 'russia';

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zriteli;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $penalty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game2;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="rfplmatches")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity=Referee::class, inversedBy="rfplmatches")
     */
    private $referee;

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

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(?string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

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

    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    public function setTeam2(?Team $team2): self
    {
        $this->team2 = $team2;

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

    public function getPlayer2(): ?Player
    {
        return $this->player2;
    }

    public function setPlayer2(?Player $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function getTour(): ?int
    {
        return $this->tour;
    }

    public function setTour(int $tour): self
    {
        $this->tour = $tour;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getGoal1(): ?int
    {
        return $this->goal1;
    }

    public function setGoal1(int $goal1): self
    {
        $this->goal1 = $goal1;

        return $this;
    }

    public function getGoal2(): ?int
    {
        return $this->goal2;
    }

    public function setGoal2(int $goal2): self
    {
        $this->goal2 = $goal2;

        return $this;
    }

    public function getBomb(): ?string
    {
        return $this->bomb;
    }

    public function setBomb(string $bomb): self
    {
        $this->bomb = $bomb;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->id;
    }

    public function getZriteli(): ?int
    {
        return $this->zriteli;
    }

    public function setZriteli(?int $zriteli): self
    {
        $this->zriteli = $zriteli;

        return $this;
    }

    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    public function setPenalty(?string $penalty): self
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(?string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getGame2(): ?string
    {
        return $this->game2;
    }

    public function setGame2(?string $game2): self
    {
        $this->game2 = $game2;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getReferee(): ?Referee
    {
        return $this->referee;
    }

    public function setReferee(?Referee $referee): self
    {
        $this->referee = $referee;

        return $this;
    }
}
