<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\AmpluaRepository::class)]
class Amplua
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: \App\Entity\Player::class, mappedBy: 'amplua')]
    private $players;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlPlayer::class, mappedBy: 'amplua')]
    private $nhlPlayers;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->nhlPlayers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setAmplua($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getAmplua() === $this) {
                $player->setAmplua(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
    }

    /**
     * @return Collection|NhlPlayer[]
     */
    public function getNhlPlayers(): Collection
    {
        return $this->nhlPlayers;
    }

    public function addNhlPlayer(NhlPlayer $nhlPlayer): self
    {
        if (!$this->nhlPlayers->contains($nhlPlayer)) {
            $this->nhlPlayers[] = $nhlPlayer;
            $nhlPlayer->setAmplua($this);
        }

        return $this;
    }

    public function removeNhlPlayer(NhlPlayer $nhlPlayer): self
    {
        if ($this->nhlPlayers->contains($nhlPlayer)) {
            $this->nhlPlayers->removeElement($nhlPlayer);
            // set the owning side to null (unless already changed)
            if ($nhlPlayer->getAmplua() === $this) {
                $nhlPlayer->setAmplua(null);
            }
        }

        return $this;
    }
}
