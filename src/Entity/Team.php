<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @ORM\Cache
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="team:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="team:item"}}},
 *     order={"name"="DESC", "id"="ASC"},
 *     paginationEnabled=false
 * )
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"team:list", "team:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"team:list", "team:item"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"team:list", "team:item"})
     */
    private $translit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"team:list", "team:item"})
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cup", mappedBy="team")
     */
    private $cups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tour", mappedBy="team")
     */
    private $tours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rfplmatch", mappedBy="team")
     */
    private $rfplmatches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eurocup", mappedBy="team")
     */
    private $eurocups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shipplayer", mappedBy="team")
     */
    private $shipplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationSupercup", mappedBy="team")
     */
    private $nationSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RusSupercup", mappedBy="team")
     */
    private $rusSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationCup", mappedBy="team")
     */
    private $nationCups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UefaSupercup", mappedBy="team")
     */
    private $uefaSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gamers", mappedBy="team")
     */
    private $gamers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fnlplayer", mappedBy="team")
     */
    private $fnlplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shiptable", mappedBy="team")
     */
    private $shiptables;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Playersteam", mappedBy="team")
     */
    private $playersteams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cupplayer", mappedBy="team")
     */
    private $cupplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ectable", mappedBy="team")
     */
    private $ectables;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lchplayer", mappedBy="team")
     */
    private $lchplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ecplayer", mappedBy="team")
     */
    private $ecplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supercupplayer", mappedBy="team")
     */
    private $supercupplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sostav", mappedBy="team")
     */
    private $sostavs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image = "-";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image2 = "-";

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $game = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wins = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nich = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $porazh = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mz = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mp = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score = 0;

    /**
     * @ORM\OneToMany(targetEntity=Transfer::class, mappedBy="old")
     */
    private $transfers;

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
        $this->playersteams = new ArrayCollection();
        $this->cupplayers = new ArrayCollection();
        $this->ectables = new ArrayCollection();
        $this->lchplayers = new ArrayCollection();
        $this->ecplayers = new ArrayCollection();
        $this->supercupplayers = new ArrayCollection();
        $this->sostavs = new ArrayCollection();
        $this->transfers = new ArrayCollection();
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

    public function getTranslit(): ?string
    {
        return $this->translit;
    }

    public function setTranslit(string $translit): self
    {
        $this->translit = $translit;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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
            $cup->setTeam($this);
        }

        return $this;
    }

    public function removeCup(Cup $cup): self
    {
        if ($this->cups->contains($cup)) {
            $this->cups->removeElement($cup);
            // set the owning side to null (unless already changed)
            if ($cup->getTeam() === $this) {
                $cup->setTeam(null);
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
            $tour->setTeam($this);
        }

        return $this;
    }

    public function removeTour(Tour $tour): self
    {
        if ($this->tours->contains($tour)) {
            $this->tours->removeElement($tour);
            // set the owning side to null (unless already changed)
            if ($tour->getTeam() === $this) {
                $tour->setTeam(null);
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
            $rfplmatch->setTeam($this);
        }

        return $this;
    }

    public function removeRfplmatch(Rfplmatch $rfplmatch): self
    {
        if ($this->rfplmatches->contains($rfplmatch)) {
            $this->rfplmatches->removeElement($rfplmatch);
            // set the owning side to null (unless already changed)
            if ($rfplmatch->getTeam() === $this) {
                $rfplmatch->setTeam(null);
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
            $eurocup->setTeam($this);
        }

        return $this;
    }

    public function removeEurocup(Eurocup $eurocup): self
    {
        if ($this->eurocups->contains($eurocup)) {
            $this->eurocups->removeElement($eurocup);
            // set the owning side to null (unless already changed)
            if ($eurocup->getTeam() === $this) {
                $eurocup->setTeam(null);
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
            $shipplayer->setTeam($this);
        }

        return $this;
    }

    public function removeShipplayer(Shipplayer $shipplayer): self
    {
        if ($this->shipplayers->contains($shipplayer)) {
            $this->shipplayers->removeElement($shipplayer);
            // set the owning side to null (unless already changed)
            if ($shipplayer->getTeam() === $this) {
                $shipplayer->setTeam(null);
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
            $nationSupercup->setTeam($this);
        }

        return $this;
    }

    public function removeNationSupercup(NationSupercup $nationSupercup): self
    {
        if ($this->nationSupercups->contains($nationSupercup)) {
            $this->nationSupercups->removeElement($nationSupercup);
            // set the owning side to null (unless already changed)
            if ($nationSupercup->getTeam() === $this) {
                $nationSupercup->setTeam(null);
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
            $rusSupercup->setTeam($this);
        }

        return $this;
    }

    public function removeRusSupercup(RusSupercup $rusSupercup): self
    {
        if ($this->rusSupercups->contains($rusSupercup)) {
            $this->rusSupercups->removeElement($rusSupercup);
            // set the owning side to null (unless already changed)
            if ($rusSupercup->getTeam() === $this) {
                $rusSupercup->setTeam(null);
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
            $nationCup->setTeam($this);
        }

        return $this;
    }

    public function removeNationCup(NationCup $nationCup): self
    {
        if ($this->nationCups->contains($nationCup)) {
            $this->nationCups->removeElement($nationCup);
            // set the owning side to null (unless already changed)
            if ($nationCup->getTeam() === $this) {
                $nationCup->setTeam(null);
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
            $uefaSupercup->setTeam($this);
        }

        return $this;
    }

    public function removeUefaSupercup(UefaSupercup $uefaSupercup): self
    {
        if ($this->uefaSupercups->contains($uefaSupercup)) {
            $this->uefaSupercups->removeElement($uefaSupercup);
            // set the owning side to null (unless already changed)
            if ($uefaSupercup->getTeam() === $this) {
                $uefaSupercup->setTeam(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return (string)$this->name;
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
            $gamer->setTeam($this);
        }

        return $this;
    }

    public function removeGamer(Gamers $gamer): self
    {
        if ($this->gamers->contains($gamer)) {
            $this->gamers->removeElement($gamer);
            // set the owning side to null (unless already changed)
            if ($gamer->getTeam() === $this) {
                $gamer->setTeam(null);
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
            $fnlplayer->setTeam($this);
        }

        return $this;
    }

    public function removeFnlplayer(Fnlplayer $fnlplayer): self
    {
        if ($this->fnlplayers->contains($fnlplayer)) {
            $this->fnlplayers->removeElement($fnlplayer);
            // set the owning side to null (unless already changed)
            if ($fnlplayer->getTeam() === $this) {
                $fnlplayer->setTeam(null);
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
            $shiptable->setTeam($this);
        }

        return $this;
    }

    public function removeShiptable(Shiptable $shiptable): self
    {
        if ($this->shiptables->contains($shiptable)) {
            $this->shiptables->removeElement($shiptable);
            // set the owning side to null (unless already changed)
            if ($shiptable->getTeam() === $this) {
                $shiptable->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Playersteam[]
     */
    public function getPlayersteams(): Collection
    {
        return $this->playersteams;
    }

    public function addPlayersteam(Playersteam $playersteam): self
    {
        if (!$this->playersteams->contains($playersteam)) {
            $this->playersteams[] = $playersteam;
            $playersteam->setTeam($this);
        }

        return $this;
    }

    public function removePlayersteam(Playersteam $playersteam): self
    {
        if ($this->playersteams->contains($playersteam)) {
            $this->playersteams->removeElement($playersteam);
            // set the owning side to null (unless already changed)
            if ($playersteam->getTeam() === $this) {
                $playersteam->setTeam(null);
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
            $cupplayer->setTeam($this);
        }

        return $this;
    }

    public function removeCupplayer(Cupplayer $cupplayer): self
    {
        if ($this->cupplayers->contains($cupplayer)) {
            $this->cupplayers->removeElement($cupplayer);
            // set the owning side to null (unless already changed)
            if ($cupplayer->getTeam() === $this) {
                $cupplayer->setTeam(null);
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
            $ectable->setTeam($this);
        }

        return $this;
    }

    public function removeEctable(Ectable $ectable): self
    {
        if ($this->ectables->contains($ectable)) {
            $this->ectables->removeElement($ectable);
            // set the owning side to null (unless already changed)
            if ($ectable->getTeam() === $this) {
                $ectable->setTeam(null);
            }
        }

        return $this;
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
            $lchplayer->setTeam($this);
        }

        return $this;
    }

    public function removeLchplayer(Lchplayer $lchplayer): self
    {
        if ($this->lchplayers->contains($lchplayer)) {
            $this->lchplayers->removeElement($lchplayer);
            // set the owning side to null (unless already changed)
            if ($lchplayer->getTeam() === $this) {
                $lchplayer->setTeam(null);
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
            $ecplayer->setTeam($this);
        }

        return $this;
    }

    public function removeEcplayer(Ecplayer $ecplayer): self
    {
        if ($this->ecplayers->contains($ecplayer)) {
            $this->ecplayers->removeElement($ecplayer);
            // set the owning side to null (unless already changed)
            if ($ecplayer->getTeam() === $this) {
                $ecplayer->setTeam(null);
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
            $supercupplayer->setTeam($this);
        }

        return $this;
    }

    public function removeSupercupplayer(Supercupplayer $supercupplayer): self
    {
        if ($this->supercupplayers->contains($supercupplayer)) {
            $this->supercupplayers->removeElement($supercupplayer);
            // set the owning side to null (unless already changed)
            if ($supercupplayer->getTeam() === $this) {
                $supercupplayer->setTeam(null);
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
            $sostav->setTeam($this);
        }

        return $this;
    }

    public function removeSostav(Sostav $sostav): self
    {
        if ($this->sostavs->contains($sostav)) {
            $this->sostavs->removeElement($sostav);
            // set the owning side to null (unless already changed)
            if ($sostav->getTeam() === $this) {
                $sostav->setTeam(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(?int $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(?int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getNich(): ?int
    {
        return $this->nich;
    }

    public function setNich(?int $nich): self
    {
        $this->nich = $nich;

        return $this;
    }

    public function getPorazh(): ?int
    {
        return $this->porazh;
    }

    public function setPorazh(?int $porazh): self
    {
        $this->porazh = $porazh;

        return $this;
    }

    public function getMz(): ?int
    {
        return $this->mz;
    }

    public function setMz(?int $mz): self
    {
        $this->mz = $mz;

        return $this;
    }

    public function getMp(): ?int
    {
        return $this->mp;
    }

    public function setMp(?int $mp): self
    {
        $this->mp = $mp;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection|Transfer[]
     */
    public function getTransfers(): Collection
    {
        return $this->transfers;
    }

    public function addTransfer(Transfer $transfer): self
    {
        if (!$this->transfers->contains($transfer)) {
            $this->transfers[] = $transfer;
            $transfer->setOld($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->removeElement($transfer)) {
            // set the owning side to null (unless already changed)
            if ($transfer->getOld() === $this) {
                $transfer->setOld(null);
            }
        }

        return $this;
    }
}
