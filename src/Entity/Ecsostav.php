<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\EcsostavRepository::class)]
class Ecsostav
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\OneToOne(targetEntity: \App\Entity\Eurocup::class, cascade: ['persist', 'remove'])]
    private $eurocup;

    #[ORM\Column(type: 'string', length: 255)]
    private $team;

    #[ORM\Column(type: 'string', length: 255)]
    private $team2;

    #[ORM\ManyToOne(targetEntity: City::class, inversedBy: 'ecsostavs')]
    private $city;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $zriteli;

    #[ORM\ManyToOne(targetEntity: Referee::class, inversedBy: 'ecsostavs')]
    private $referee;

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

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

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
