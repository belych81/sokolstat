<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonsRepository")
 */
class Seasons
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name = '2020-21';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cup", mappedBy="season")
     */
    private $cups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tour", mappedBy="season")
     */
    private $tours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rfplmatch", mappedBy="season")
     */
    private $rfplmatches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlReg", mappedBy="season")
     */
    private $nhlRegs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eurocup", mappedBy="season")
     */
    private $eurocups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shipplayer", mappedBy="season")
     */
    private $shipplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationSupercup", mappedBy="season")
     */
    private $nationSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RusSupercup", mappedBy="season")
     */
    private $rusSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationCup", mappedBy="season")
     */
    private $nationCups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UefaSupercup", mappedBy="season")
     */
    private $uefaSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gamers", mappedBy="season")
     */
    private $gamers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fnlplayer", mappedBy="season")
     */
    private $fnlplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shiptable", mappedBy="season")
     */
    private $shiptables;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cupplayer", mappedBy="season")
     */
    private $cupplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ectable", mappedBy="season")
     */
    private $ectables;

    private $laststadia = 'final';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lchplayer", mappedBy="season")
     */
    private $lchplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ecplayer", mappedBy="season")
     */
    private $ecplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supercupplayer", mappedBy="season")
     */
    private $supercupplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sbplayer", mappedBy="season")
     */
    private $sbplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mundial", mappedBy="season")
     */
    private $mundials;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sostav", mappedBy="season")
     */
    private $sostavs;

    private $season_matches;

    private $season_cup_matches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlTable", mappedBy="season")
     */
    private $nhlTables;

    /**
     * @ORM\OneToMany(targetEntity=CupLeague::class, mappedBy="season")
     */
    private $cupLeagues;

    public function __construct()
    {
        $this->cups = new ArrayCollection();
        $this->tours = new ArrayCollection();
        $this->rfplmatches = new ArrayCollection();
        $this->eurocups = new ArrayCollection();
        $this->shipplayers = new ArrayCollection();
        $this->nationSupercups = new ArrayCollection();
        $this->rusSupercups = new ArrayCollection();
        $this->nationCups = new ArrayCollection();
        $this->uefaSupercups = new ArrayCollection();
        $this->gamers = new ArrayCollection();
        $this->fnlplayers = new ArrayCollection();
        $this->shiptables = new ArrayCollection();
        $this->cupplayers = new ArrayCollection();
        $this->ectables = new ArrayCollection();
        $this->lchplayers = new ArrayCollection();
        $this->ecplayers = new ArrayCollection();
        $this->supercupplayers = new ArrayCollection();
        $this->sbplayers = new ArrayCollection();
        $this->mundials = new ArrayCollection();
        $this->sostavs = new ArrayCollection();
        $this->nhlTables = new ArrayCollection();
        $this->cupLeagues = new ArrayCollection();
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
            $cup->setSeason($this);
        }

        return $this;
    }

    public function removeCup(Cup $cup): self
    {
        if ($this->cups->contains($cup)) {
            $this->cups->removeElement($cup);
            // set the owning side to null (unless already changed)
            if ($cup->getSeason() === $this) {
                $cup->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tour[]
     */
    public function getTours(): Collection
    {
        return $this->tours;
    }

    public function addTour(Tour $tour): self
    {
        if (!$this->tours->contains($tour)) {
            $this->tours[] = $tour;
            $tour->setSeason($this);
        }

        return $this;
    }

    public function removeTour(Tour $tour): self
    {
        if ($this->tours->contains($tour)) {
            $this->tours->removeElement($tour);
            // set the owning side to null (unless already changed)
            if ($tour->getSeason() === $this) {
                $tour->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rfplmatch[]
     */
    public function getRfplmatches(): Collection
    {
        return $this->rfplmatches;
    }

    public function addRfplmatch(Rfplmatch $rfplmatch): self
    {
        if (!$this->rfplmatches->contains($rfplmatch)) {
            $this->rfplmatches[] = $rfplmatch;
            $rfplmatch->setSeason($this);
        }

        return $this;
    }

    public function removeRfplmatch(Rfplmatch $rfplmatch): self
    {
        if ($this->rfplmatches->contains($rfplmatch)) {
            $this->rfplmatches->removeElement($rfplmatch);
            // set the owning side to null (unless already changed)
            if ($rfplmatch->getSeason() === $this) {
                $rfplmatch->setSeason(null);
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
            $eurocup->setSeason($this);
        }

        return $this;
    }

    public function removeEurocup(Eurocup $eurocup): self
    {
        if ($this->eurocups->contains($eurocup)) {
            $this->eurocups->removeElement($eurocup);
            // set the owning side to null (unless already changed)
            if ($eurocup->getSeason() === $this) {
                $eurocup->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Shipplayer[]
     */
    public function getShipplayers(): Collection
    {
        return $this->shipplayers;
    }

    public function addShipplayer(Shipplayer $shipplayer): self
    {
        if (!$this->shipplayers->contains($shipplayer)) {
            $this->shipplayers[] = $shipplayer;
            $shipplayer->setSeason($this);
        }

        return $this;
    }

    public function removeShipplayer(Shipplayer $shipplayer): self
    {
        if ($this->shipplayers->contains($shipplayer)) {
            $this->shipplayers->removeElement($shipplayer);
            // set the owning side to null (unless already changed)
            if ($shipplayer->getSeason() === $this) {
                $shipplayer->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NationSupercup[]
     */
    public function getNationSupercups(): Collection
    {
        return $this->nationSupercups;
    }

    public function addNationSupercup(NationSupercup $nationSupercup): self
    {
        if (!$this->nationSupercups->contains($nationSupercup)) {
            $this->nationSupercups[] = $nationSupercup;
            $nationSupercup->setSeason($this);
        }

        return $this;
    }

    public function removeNationSupercup(NationSupercup $nationSupercup): self
    {
        if ($this->nationSupercups->contains($nationSupercup)) {
            $this->nationSupercups->removeElement($nationSupercup);
            // set the owning side to null (unless already changed)
            if ($nationSupercup->getSeason() === $this) {
                $nationSupercup->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RusSupercup[]
     */
    public function getRusSupercups(): Collection
    {
        return $this->rusSupercups;
    }

    public function addRusSupercup(RusSupercup $rusSupercup): self
    {
        if (!$this->rusSupercups->contains($rusSupercup)) {
            $this->rusSupercups[] = $rusSupercup;
            $rusSupercup->setSeason($this);
        }

        return $this;
    }

    public function removeRusSupercup(RusSupercup $rusSupercup): self
    {
        if ($this->rusSupercups->contains($rusSupercup)) {
            $this->rusSupercups->removeElement($rusSupercup);
            // set the owning side to null (unless already changed)
            if ($rusSupercup->getSeason() === $this) {
                $rusSupercup->setSeason(null);
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
            $nationCup->setSeason($this);
        }

        return $this;
    }

    public function removeNationCup(NationCup $nationCup): self
    {
        if ($this->nationCups->contains($nationCup)) {
            $this->nationCups->removeElement($nationCup);
            // set the owning side to null (unless already changed)
            if ($nationCup->getSeason() === $this) {
                $nationCup->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UefaSupercup[]
     */
    public function getUefaSupercups(): Collection
    {
        return $this->uefaSupercups;
    }

    public function addUefaSupercup(UefaSupercup $uefaSupercup): self
    {
        if (!$this->uefaSupercups->contains($uefaSupercup)) {
            $this->uefaSupercups[] = $uefaSupercup;
            $uefaSupercup->setSeason($this);
        }

        return $this;
    }

    public function removeUefaSupercup(UefaSupercup $uefaSupercup): self
    {
        if ($this->uefaSupercups->contains($uefaSupercup)) {
            $this->uefaSupercups->removeElement($uefaSupercup);
            // set the owning side to null (unless already changed)
            if ($uefaSupercup->getSeason() === $this) {
                $uefaSupercup->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Gamers[]
     */
    public function getGamers(): Collection
    {
        return $this->gamers;
    }

    public function addGamer(Gamers $gamer): self
    {
        if (!$this->gamers->contains($gamer)) {
            $this->gamers[] = $gamer;
            $gamer->setSeason($this);
        }

        return $this;
    }

    public function removeGamer(Gamers $gamer): self
    {
        if ($this->gamers->contains($gamer)) {
            $this->gamers->removeElement($gamer);
            // set the owning side to null (unless already changed)
            if ($gamer->getSeason() === $this) {
                $gamer->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fnlplayer[]
     */
    public function getFnlplayers(): Collection
    {
        return $this->fnlplayers;
    }

    public function addFnlplayer(Fnlplayer $fnlplayer): self
    {
        if (!$this->fnlplayers->contains($fnlplayer)) {
            $this->fnlplayers[] = $fnlplayer;
            $fnlplayer->setSeason($this);
        }

        return $this;
    }

    public function removeFnlplayer(Fnlplayer $fnlplayer): self
    {
        if ($this->fnlplayers->contains($fnlplayer)) {
            $this->fnlplayers->removeElement($fnlplayer);
            // set the owning side to null (unless already changed)
            if ($fnlplayer->getSeason() === $this) {
                $fnlplayer->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Shiptable[]
     */
    public function getShiptables(): Collection
    {
        return $this->shiptables;
    }

    public function addShiptable(Shiptable $shiptable): self
    {
        if (!$this->shiptables->contains($shiptable)) {
            $this->shiptables[] = $shiptable;
            $shiptable->setSeason($this);
        }

        return $this;
    }

    public function removeShiptable(Shiptable $shiptable): self
    {
        if ($this->shiptables->contains($shiptable)) {
            $this->shiptables->removeElement($shiptable);
            // set the owning side to null (unless already changed)
            if ($shiptable->getSeason() === $this) {
                $shiptable->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cupplayer[]
     */
    public function getCupplayers(): Collection
    {
        return $this->cupplayers;
    }

    public function addCupplayer(Cupplayer $cupplayer): self
    {
        if (!$this->cupplayers->contains($cupplayer)) {
            $this->cupplayers[] = $cupplayer;
            $cupplayer->setSeason($this);
        }

        return $this;
    }

    public function removeCupplayer(Cupplayer $cupplayer): self
    {
        if ($this->cupplayers->contains($cupplayer)) {
            $this->cupplayers->removeElement($cupplayer);
            // set the owning side to null (unless already changed)
            if ($cupplayer->getSeason() === $this) {
                $cupplayer->setSeason(null);
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
            $ectable->setSeason($this);
        }

        return $this;
    }

    public function removeEctable(Ectable $ectable): self
    {
        if ($this->ectables->contains($ectable)) {
            $this->ectables->removeElement($ectable);
            // set the owning side to null (unless already changed)
            if ($ectable->getSeason() === $this) {
                $ectable->setSeason(null);
            }
        }

        return $this;
    }

    public function setLaststadia($laststadia)
    {
        $this->laststadia = $laststadia;

        return $this;
    }

    public function getLaststadia()
    {
        return $this->laststadia;
    }

    /**
     * @return Collection|Lchplayer[]
     */
    public function getLchplayers(): Collection
    {
        return $this->lchplayers;
    }

    public function addLchplayer(Lchplayer $lchplayer): self
    {
        if (!$this->lchplayers->contains($lchplayer)) {
            $this->lchplayers[] = $lchplayer;
            $lchplayer->setSeason($this);
        }

        return $this;
    }

    public function removeLchplayer(Lchplayer $lchplayer): self
    {
        if ($this->lchplayers->contains($lchplayer)) {
            $this->lchplayers->removeElement($lchplayer);
            // set the owning side to null (unless already changed)
            if ($lchplayer->getSeason() === $this) {
                $lchplayer->setSeason(null);
            }
        }

        return $this;
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
            $ecplayer->setSeason($this);
        }

        return $this;
    }

    public function removeEcplayer(Ecplayer $ecplayer): self
    {
        if ($this->ecplayers->contains($ecplayer)) {
            $this->ecplayers->removeElement($ecplayer);
            // set the owning side to null (unless already changed)
            if ($ecplayer->getSeason() === $this) {
                $ecplayer->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Supercupplayer[]
     */
    public function getSupercupplayers(): Collection
    {
        return $this->supercupplayers;
    }

    public function addSupercupplayer(Supercupplayer $supercupplayer): self
    {
        if (!$this->supercupplayers->contains($supercupplayer)) {
            $this->supercupplayers[] = $supercupplayer;
            $supercupplayer->setSeason($this);
        }

        return $this;
    }

    public function removeSupercupplayer(Supercupplayer $supercupplayer): self
    {
        if ($this->supercupplayers->contains($supercupplayer)) {
            $this->supercupplayers->removeElement($supercupplayer);
            // set the owning side to null (unless already changed)
            if ($supercupplayer->getSeason() === $this) {
                $supercupplayer->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sbplayer[]
     */
    public function getSbplayers(): Collection
    {
        return $this->sbplayers;
    }

    public function addSbplayer(Sbplayer $sbplayer): self
    {
        if (!$this->sbplayers->contains($sbplayer)) {
            $this->sbplayers[] = $sbplayer;
            $sbplayer->setSeason($this);
        }

        return $this;
    }

    public function removeSbplayer(Sbplayer $sbplayer): self
    {
        if ($this->sbplayers->contains($sbplayer)) {
            $this->sbplayers->removeElement($sbplayer);
            // set the owning side to null (unless already changed)
            if ($sbplayer->getSeason() === $this) {
                $sbplayer->setSeason(null);
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
            $mundial->setSeason($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getSeason() === $this) {
                $mundial->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sostav[]
     */
    public function getSostavs(): Collection
    {
        return $this->sostavs;
    }

    public function addSostav(Sostav $sostav): self
    {
        if (!$this->sostavs->contains($sostav)) {
            $this->sostavs[] = $sostav;
            $sostav->setSeason($this);
        }

        return $this;
    }

    public function removeSostav(Sostav $sostav): self
    {
        if ($this->sostavs->contains($sostav)) {
            $this->sostavs->removeElement($sostav);
            // set the owning side to null (unless already changed)
            if ($sostav->getSeason() === $this) {
                $sostav->setSeason(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
    }

    public function getSeasonMatches()
    {
        return $this->season_matches;
    }

    public function setSeasonMatches($season_matches): self
    {
        $this->season_matches = $season_matches;

        return $this;
    }

    public function getSeasonCupMatches()
    {
        return $this->season_cup_matches;
    }

    public function setSeasonCupMatches($season_cup_matches): self
    {
        $this->season_cup_matches = $season_cup_matches;

        return $this;
    }

    /**
     * @return Collection|NhlTable[]
     */
    public function getNhlTables(): Collection
    {
        return $this->nhlTables;
    }

    public function addNhlTable(NhlTable $nhlTable): self
    {
        if (!$this->nhlTables->contains($nhlTable)) {
            $this->nhlTables[] = $nhlTable;
            $nhlTable->setSeason($this);
        }

        return $this;
    }

    public function removeNhlTable(NhlTable $nhlTable): self
    {
        if ($this->nhlTables->contains($nhlTable)) {
            $this->nhlTables->removeElement($nhlTable);
            // set the owning side to null (unless already changed)
            if ($nhlTable->getSeason() === $this) {
                $nhlTable->setSeason(null);
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
            $cupLeague->setSeason($this);
        }

        return $this;
    }

    public function removeCupLeague(CupLeague $cupLeague): self
    {
        if ($this->cupLeagues->removeElement($cupLeague)) {
            // set the owning side to null (unless already changed)
            if ($cupLeague->getSeason() === $this) {
                $cupLeague->setSeason(null);
            }
        }

        return $this;
    }
}
