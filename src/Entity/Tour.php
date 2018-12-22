<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TourRepository")
 */
class Tour
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="tours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="tours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="tours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="tours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $tour;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal1;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bomb;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    public function setBomb(?string $bomb): self
    {
        $this->bomb = $bomb;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
