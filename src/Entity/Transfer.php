<?php

namespace App\Entity;

use App\Repository\TransferRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\TransferRepository::class)]
class Transfer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $player;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'transfers')]
    private $old;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'transfers')]
    private $new;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Period::class, inversedBy: 'transfers')]
    private $period;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?string
    {
        return $this->player;
    }

    public function setPlayer(?string $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getOld(): ?Team
    {
        return $this->old;
    }

    public function setOld(?Team $old): self
    {
        $this->old = $old;

        return $this;
    }

    public function getNew(): ?Team
    {
        return $this->new;
    }

    public function setNew(?Team $new): self
    {
        $this->new = $new;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }
}
