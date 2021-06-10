<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MundialRepository")
 */
class Mundial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turnir", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turnir;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stadia", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stadia;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $goal = '-';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $score = '0-0';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $game = '-';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $game2 = '-';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $penalty = '-';

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="integer")
     */
    private $zriteli = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status = true;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Referee", inversedBy="mundials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $referee;

    private $route = 'sbornie';

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSeason(): ?Seasons
    {
        return $this->season;
    }

    public function setSeason(?Seasons $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry2(): ?Country
    {
        return $this->country2;
    }

    public function setCountry2(?Country $country2): self
    {
        $this->country2 = $country2;

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

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getGame2(): ?string
    {
        return $this->game2;
    }

    public function setGame2(string $game2): self
    {
        $this->game2 = $game2;

        return $this;
    }

    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    public function setPenalty(string $penalty): self
    {
        $this->penalty = $penalty;

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

    public function getZriteli(): ?int
    {
        return $this->zriteli;
    }

    public function setZriteli(int $zriteli): self
    {
        $this->zriteli = $zriteli;

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

    public function getReferee(): ?Referee
    {
        return $this->referee;
    }

    public function setReferee(?Referee $referee): self
    {
        $this->referee = $referee;

        return $this;
    }

    public function __toString()
    {
      return (string)$this->id;
    }
}
