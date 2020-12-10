<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcsostavRepository")
 */
class Ecsostav
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Eurocup", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $eurocup;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $team;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $team2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEurocup(): ?Eurocup
    {
        return $this->eurocup;
    }

    public function setEurocup(Eurocup $eurocup): self
    {
        $this->eurocup = $eurocup;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(string $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getTeam2(): ?string
    {
        return $this->team2;
    }

    public function setTeam2(string $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }

    public function __toString()
    {
      return $this->team."\n".$this->team2;
    }
}
