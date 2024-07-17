<?php

namespace App\Entity;

use App\Repository\AchieveItemsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\AchieveItemsRepository::class)]
class AchieveItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'achieveItems')]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'achieveItems')]
    private ?Achieve $achieve = null;

    #[ORM\ManyToOne(inversedBy: 'achieveItems')]
    private ?Seasons $season = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getAchieve(): ?Achieve
    {
        return $this->achieve;
    }

    public function setAchieve(?Achieve $achieve): static
    {
        $this->achieve = $achieve;

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
}
