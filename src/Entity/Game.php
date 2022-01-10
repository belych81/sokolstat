<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Seasons::class, inversedBy="games")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="games")
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     */
    private $team2;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="games")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     */
    private $player2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tour = 1;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goal1 = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goal2 = 0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bomb = '-';

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="games")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity=Referee::class, inversedBy="games")
     */
    private $referee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zriteli = 0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $penalty = '-';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game = '-';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game2 = '-';

    /**
     * @ORM\ManyToOne(targetEntity=Turnir::class, inversedBy="games")
     */
    private $turnir;

    /**
     * @ORM\ManyToOne(targetEntity=Stadia::class, inversedBy="games")
     */
    private $stadia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $score = '0-0';

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

    public function setTour(?int $tour): self
    {
        $this->tour = $tour;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getGoal1(): ?int
    {
        return $this->goal1;
    }

    public function setGoal1(?int $goal1): self
    {
        $this->goal1 = $goal1;

        return $this;
    }

    public function getGoal2(): ?int
    {
        return $this->goal2;
    }

    public function setGoal2(?int $goal2): self
    {
        $this->goal2 = $goal2;

        return $this;
    }

    public function getBomb(): ?string
    {
        return $this->bomb;
    }

    public function setBomb(?string $bomb): self
    {
        $this->bomb = $bomb;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

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

    public function getTurnir(): ?Turnir
    {
        return $this->turnir;
    }

    public function setTurnir(?Turnir $turnir): self
    {
        $this->turnir = $turnir;

        return $this;
    }

    public function getStadia(): ?Stadia
    {
        return $this->stadia;
    }

    public function setStadia(?Stadia $stadia): self
    {
        $this->stadia = $stadia;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): self
    {
        $this->score = $score;

        return $this;
    }
}
