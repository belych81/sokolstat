<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlMatchRepository")
 */
class NhlMatch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seasons", inversedBy="matches")
     */
    private $season;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam", inversedBy="nhlMatches")
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlTeam")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team2;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal1 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal2 = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlStadia", inversedBy="nhlMatches")
     */
    private $stadia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bomb = "-";

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $overtime = null;

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

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

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

    public function getTeam2(): ?NhlTeam
    {
        return $this->team2;
    }

    public function setTeam2(?NhlTeam $team2): self
    {
        $this->team2 = $team2;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStadia(): ?NhlStadia
    {
        return $this->stadia;
    }

    public function setStadia(?NhlStadia $stadia): self
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

    public function __toString(): string
    {
      return $this->getBomb();
    }

    public function getJsonData()
    {
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_object($value) && method_exists($value, 'getJsonData')) {
                $value = $value->getJsonData();
            }
        }
        return $var;
    }

    public function isOvertime(): ?bool
    {
        return $this->overtime;
    }

    public function setOvertime(?bool $overtime): static
    {
        $this->overtime = $overtime;

        return $this;
    }
}
