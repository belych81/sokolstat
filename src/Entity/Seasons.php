<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: \App\Repository\SeasonsRepository::class)]
class Seasons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name = '2020-21';

    #[ORM\OneToMany(targetEntity: \App\Entity\Cup::class, mappedBy: 'season')]
    private $cups;

    #[ORM\OneToMany(targetEntity: \App\Entity\Tour::class, mappedBy: 'season')]
    private $tours;

    #[ORM\OneToMany(targetEntity: \App\Entity\Rfplmatch::class, mappedBy: 'season')]
    private $rfplmatches;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlReg::class, mappedBy: 'season')]
    private $nhlRegs;

    #[ORM\OneToMany(targetEntity: \App\Entity\Eurocup::class, mappedBy: 'season')]
    private $eurocups;

    #[ORM\OneToMany(targetEntity: \App\Entity\Shipplayer::class, mappedBy: 'season')]
    private $shipplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\NationSupercup::class, mappedBy: 'season')]
    private $nationSupercups;

    #[ORM\OneToMany(targetEntity: \App\Entity\RusSupercup::class, mappedBy: 'season')]
    private $rusSupercups;

    #[ORM\OneToMany(targetEntity: \App\Entity\NationCup::class, mappedBy: 'season')]
    private $nationCups;

    #[ORM\OneToMany(targetEntity: \App\Entity\UefaSupercup::class, mappedBy: 'season')]
    private $uefaSupercups;

    #[ORM\OneToMany(targetEntity: \App\Entity\Gamers::class, mappedBy: 'season')]
    private $gamers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Fnlplayer::class, mappedBy: 'season')]
    private $fnlplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Shiptable::class, mappedBy: 'season')]
    private $shiptables;

    #[ORM\OneToMany(targetEntity: \App\Entity\Cupplayer::class, mappedBy: 'season')]
    private $cupplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Ectable::class, mappedBy: 'season')]
    private $ectables;

    private $laststadia = 'final';

    #[ORM\OneToMany(targetEntity: \App\Entity\Lchplayer::class, mappedBy: 'season')]
    private $lchplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Ecplayer::class, mappedBy: 'season')]
    private $ecplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Supercupplayer::class, mappedBy: 'season')]
    private $supercupplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Sbplayer::class, mappedBy: 'season')]
    private $sbplayers;

    #[ORM\OneToMany(targetEntity: \App\Entity\Mundial::class, mappedBy: 'season')]
    private $mundials;

    #[ORM\OneToMany(targetEntity: \App\Entity\Sostav::class, mappedBy: 'season')]
    private $sostavs;

    private $season_matches;

    private $season_cup_matches;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlTable::class, mappedBy: 'season')]
    private $nhlTables;

    #[ORM\OneToMany(targetEntity: CupLeague::class, mappedBy: 'season')]
    private $cupLeagues;

    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'season')]
    private $games;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: NflMatch::class)]
    private Collection $nflMatches;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $lastdate = null;

    #[ORM\Column(type: 'integer')]
    private ?int $lastId = null;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: AchieveItems::class)]
    private Collection $achieveItems;

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
        $this->games = new ArrayCollection();
        $this->nflMatches = new ArrayCollection();
        $this->achieveItems = new ArrayCollection();
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
            $game->setSeason($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getSeason() === $this) {
                $game->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NflMatch>
     */
    public function getNflMatches(): Collection
    {
        return $this->nflMatches;
    }

    public function addNflMatch(NflMatch $nflMatch): static
    {
        if (!$this->nflMatches->contains($nflMatch)) {
            $this->nflMatches->add($nflMatch);
            $nflMatch->setSeason($this);
        }

        return $this;
    }

    public function removeNflMatch(NflMatch $nflMatch): static
    {
        if ($this->nflMatches->removeElement($nflMatch)) {
            // set the owning side to null (unless already changed)
            if ($nflMatch->getSeason() === $this) {
                $nflMatch->setSeason(null);
            }
        }

        return $this;
    }

    public function getLastdate(): ?\DateTimeInterface
    {
        return $this->lastdate;
    }

    public function setLastdate(?\DateTimeInterface $lastdate): static
    {
        $this->lastdate = $lastdate;

        return $this;
    }

    public function getLastId(): ?int
    {
        return $this->lastId;
    }

    public function setLastId(?int $lastId): static
    {
        $this->lastId = $lastId;

        return $this;
    }

    /**
     * @return Collection<int, AchieveItems>
     */
    public function getAchieveItems(): Collection
    {
        return $this->achieveItems;
    }

    public function addAchieveItem(AchieveItems $achieveItem): static
    {
        if (!$this->achieveItems->contains($achieveItem)) {
            $this->achieveItems->add($achieveItem);
            $achieveItem->setSeason($this);
        }

        return $this;
    }

    public function removeAchieveItem(AchieveItems $achieveItem): static
    {
        if ($this->achieveItems->removeElement($achieveItem)) {
            // set the owning side to null (unless already changed)
            if ($achieveItem->getSeason() === $this) {
                $achieveItem->setSeason(null);
            }
        }

        return $this;
    }
}
