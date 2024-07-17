<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\TurnirRepository::class)]
class Turnir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $alias;

    #[ORM\OneToMany(targetEntity: \App\Entity\Eurocup::class, mappedBy: 'turnir')]
    private $eurocups;

    #[ORM\OneToMany(targetEntity: \App\Entity\Ectable::class, mappedBy: 'turnir')]
    private $ectables;

    #[ORM\Column(type: 'string', length: 255)]
    private $russianalias;

    #[ORM\OneToMany(targetEntity: \App\Entity\Ecplayer::class, mappedBy: 'turnir')]
    private $ecplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Mundial::class, mappedBy: 'turnir')]
    private $mundials;

    #[ORM\OneToMany(targetEntity: MundialTable::class, mappedBy: 'turnir')]
    private $mundialTables;

    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'turnir')]
    private $games;

    public function __construct()
    {
        $this->eurocups = new ArrayCollection();
        $this->ectables = new ArrayCollection();
        $this->ecplayers = new ArrayCollection();
        $this->mundials = new ArrayCollection();
        $this->mundialTables = new ArrayCollection();
        $this->games = new ArrayCollection();
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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }


    /**
     * @return Collection|Eurocup[]
     */
    public function getEurocups(): Collection
    {
        return $this->eurocups;
    }

    public function addEurocup(Eurocup $eurocup): self
    {
        if (!$this->eurocups->contains($eurocup)) {
            $this->eurocups[] = $eurocup;
            $eurocup->setTurnir($this);
        }

        return $this;
    }

    public function removeEurocup(Eurocup $eurocup): self
    {
        if ($this->eurocups->contains($eurocup)) {
            $this->eurocups->removeElement($eurocup);
            // set the owning side to null (unless already changed)
            if ($eurocup->getTurnir() === $this) {
                $eurocup->setTurnir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ectable[]
     */
    public function getEctables(): Collection
    {
        return $this->ectables;
    }

    public function addEctable(Ectable $ectable): self
    {
        if (!$this->ectables->contains($ectable)) {
            $this->ectables[] = $ectable;
            $ectable->setTurnir($this);
        }

        return $this;
    }

    public function removeEctable(Ectable $ectable): self
    {
        if ($this->ectables->contains($ectable)) {
            $this->ectables->removeElement($ectable);
            // set the owning side to null (unless already changed)
            if ($ectable->getTurnir() === $this) {
                $ectable->setTurnir(null);
            }
        }

        return $this;
    }

    public function getRussianalias(): ?string
    {
        return $this->russianalias;
    }

    public function setRussianalias(string $russianalias): self
    {
        $this->russianalias = $russianalias;

        return $this;
    }

    public function __toString(): string
    {
      return $this->name;
    }

    /**
     * @return Collection|Ecplayer[]
     */
    public function getEcplayers(): Collection
    {
        return $this->ecplayers;
    }

    public function addEcplayer(Ecplayer $ecplayer): self
    {
        if (!$this->ecplayers->contains($ecplayer)) {
            $this->ecplayers[] = $ecplayer;
            $ecplayer->setTurnir($this);
        }

        return $this;
    }

    public function removeEcplayer(Ecplayer $ecplayer): self
    {
        if ($this->ecplayers->contains($ecplayer)) {
            $this->ecplayers->removeElement($ecplayer);
            // set the owning side to null (unless already changed)
            if ($ecplayer->getTurnir() === $this) {
                $ecplayer->setTurnir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mundial[]
     */
    public function getMundials(): Collection
    {
        return $this->mundials;
    }

    public function addMundial(Mundial $mundial): self
    {
        if (!$this->mundials->contains($mundial)) {
            $this->mundials[] = $mundial;
            $mundial->setTurnir($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getTurnir() === $this) {
                $mundial->setTurnir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MundialTable[]
     */
    public function getMundialTables(): Collection
    {
        return $this->mundialTables;
    }

    public function addMundialTable(MundialTable $mundialTable): self
    {
        if (!$this->mundialTables->contains($mundialTable)) {
            $this->mundialTables[] = $mundialTable;
            $mundialTable->setTurnir($this);
        }

        return $this;
    }

    public function removeMundialTable(MundialTable $mundialTable): self
    {
        if ($this->mundialTables->removeElement($mundialTable)) {
            // set the owning side to null (unless already changed)
            if ($mundialTable->getTurnir() === $this) {
                $mundialTable->setTurnir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setTurnir($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getTurnir() === $this) {
                $game->setTurnir(null);
            }
        }

        return $this;
    }

}
