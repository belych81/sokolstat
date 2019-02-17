<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NationCupRepository")
 */
class NationCup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="nationCups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="nationCups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="nationCups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="nationCups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stadia", inversedBy="nationCups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stadia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bomb = "-";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $score = "0-0";

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="boolean")
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

    public function getStadia(): ?Stadia
    {
        return $this->stadia;
    }

    public function setStadia(?Stadia $stadia): self
    {
        $this->stadia = $stadia;

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

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
