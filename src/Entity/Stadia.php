<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\StadiaRepository::class)]
class Stadia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $alias;

    #[ORM\OneToMany(targetEntity: \App\Entity\Cup::class, mappedBy: 'stadia')]
    private $cups;

    #[ORM\OneToMany(targetEntity: \App\Entity\Eurocup::class, mappedBy: 'stadia')]
    private $eurocups;

    #[ORM\OneToMany(targetEntity: \App\Entity\NationCup::class, mappedBy: 'stadia')]
    private $nationCups;

    public function __construct()
    {
        $this->cups = new ArrayCollection();
        $this->eurocups = new ArrayCollection();
        $this->nationCups = new ArrayCollection();
        $this->ectables = new ArrayCollection();
        $this->mundials = new ArrayCollection();
        $this->mundialTables = new ArrayCollection();
        $this->cupLeagues = new ArrayCollection();
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
     * @return Collection|Cup[]
     */
    public function getCups(): Collection
    {
        return $this->cups;
    }

    public function addCup(Cup $cup): self
    {
        if (!$this->cups->contains($cup)) {
            $this->cups[] = $cup;
            $cup->setStadia($this);
        }

        return $this;
    }

    public function removeCup(Cup $cup): self
    {
        if ($this->cups->contains($cup)) {
            $this->cups->removeElement($cup);
            // set the owning side to null (unless already changed)
            if ($cup->getStadia() === $this) {
                $cup->setStadia(null);
            }
        }

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
            $eurocup->setStadia($this);
        }

        return $this;
    }

    public function removeEurocup(Eurocup $eurocup): self
    {
        if ($this->eurocups->contains($eurocup)) {
            $this->eurocups->removeElement($eurocup);
            // set the owning side to null (unless already changed)
            if ($eurocup->getStadia() === $this) {
                $eurocup->setStadia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NationCup[]
     */
    public function getNationCups(): Collection
    {
        return $this->nationCups;
    }

    public function addNationCup(NationCup $nationCup): self
    {
        if (!$this->nationCups->contains($nationCup)) {
            $this->nationCups[] = $nationCup;
            $nationCup->setStadia($this);
        }

        return $this;
    }

    public function removeNationCup(NationCup $nationCup): self
    {
        if ($this->nationCups->contains($nationCup)) {
            $this->nationCups->removeElement($nationCup);
            // set the owning side to null (unless already changed)
            if ($nationCup->getStadia() === $this) {
                $nationCup->setStadia(null);
            }
        }

        return $this;
    }

    private $stadia_matches;

    private $stadia_matches_1;

    private $stadia_matches_2;

    #[ORM\OneToMany(targetEntity: \App\Entity\Ectable::class, mappedBy: 'stadia')]
    private $ectables;

    #[ORM\OneToMany(targetEntity: \App\Entity\Mundial::class, mappedBy: 'stadia')]
    private $mundials;

    public function setStadiaMatches(array $matches)
    {
        $this->stadia_matches = $matches;
    }

    public function getStadiaMatches(): ?array
    {
        return $this->stadia_matches;
    }

    public function setStadiaMatches1(array $matches)
    {
        $this->stadia_matches_1 = $matches;
    }

    public function getStadiaMatches1(): ?array
    {
        return $this->stadia_matches_1;
    }

    public function setStadiaMatches2(array $matches)
    {
        $this->stadia_matches_2 = $matches;
    }

    public function getStadiaMatches2(): ?array
    {
        return $this->stadia_matches_2;
    }

    private $stadia_table = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rank;

    #[ORM\OneToMany(targetEntity: MundialTable::class, mappedBy: 'stadia')]
    private $mundialTables;

    #[ORM\OneToMany(targetEntity: CupLeague::class, mappedBy: 'stadia')]
    private $cupLeagues;

    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'stadia')]
    private $games;

    public function setStadiaTable($table)
    {
        $this->stadia_table = $table;
    }

    public function getStadiaTable()
    {
        return $this->stadia_table;
    }

    public function __toString()
    {
        return $this->name;
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
            $ectable->setStadia($this);
        }

        return $this;
    }

    public function removeEctable(Ectable $ectable): self
    {
        if ($this->ectables->contains($ectable)) {
            $this->ectables->removeElement($ectable);
            // set the owning side to null (unless already changed)
            if ($ectable->getStadia() === $this) {
                $ectable->setStadia(null);
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
            $mundial->setStadia($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getStadia() === $this) {
                $mundial->setStadia(null);
            }
        }

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(?int $rank): self
    {
        $this->rank = $rank;

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
            $mundialTable->setStadia($this);
        }

        return $this;
    }

    public function removeMundialTable(MundialTable $mundialTable): self
    {
        if ($this->mundialTables->removeElement($mundialTable)) {
            // set the owning side to null (unless already changed)
            if ($mundialTable->getStadia() === $this) {
                $mundialTable->setStadia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CupLeague[]
     */
    public function getCupLeagues(): Collection
    {
        return $this->cupLeagues;
    }

    public function addCupLeague(CupLeague $cupLeague): self
    {
        if (!$this->cupLeagues->contains($cupLeague)) {
            $this->cupLeagues[] = $cupLeague;
            $cupLeague->setStadia($this);
        }

        return $this;
    }

    public function removeCupLeague(CupLeague $cupLeague): self
    {
        if ($this->cupLeagues->removeElement($cupLeague)) {
            // set the owning side to null (unless already changed)
            if ($cupLeague->getStadia() === $this) {
                $cupLeague->setStadia(null);
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
            $game->setStadia($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getStadia() === $this) {
                $game->setStadia(null);
            }
        }

        return $this;
    }
}
