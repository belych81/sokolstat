<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Amplua", inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amplua;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $born;

    /**
     * @ORM\Column(type="integer")
     */
    private $goal = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $lch_game = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $lch_goal = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $translit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image = "-";

    /**
     * @ORM\Column(type="integer")
     */
    private $cup = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $supercup = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $eurocup = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $sum = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rfplmatch", mappedBy="player")
     */
    private $rfplmatches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shipplayer", mappedBy="player")
     */
    private $shipplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rusplayer", mappedBy="player")
     */
    private $rusplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gamers", mappedBy="player")
     */
    private $gamers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fnlplayer", mappedBy="player")
     */
    private $fnlplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Playersteam", mappedBy="player")
     */
    private $playersteams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cupplayer", mappedBy="player")
     */
    private $cupplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lchplayer", mappedBy="player")
     */
    private $lchplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ecplayer", mappedBy="player")
     */
    private $ecplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supercupplayer", mappedBy="player")
     */
    private $supercupplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sbplayer", mappedBy="player")
     */
    private $sbplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sostav", mappedBy="player")
     */
    private $sostavs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $insertdate;

    /**
     * @ORM\Column(type="integer")
     */
    private $game = 0;

    public function __construct()
    {
        $this->rfplmatches = new ArrayCollection();
        $this->shipplayers = new ArrayCollection();
        $this->rusplayers = new ArrayCollection();
        $this->gamers = new ArrayCollection();
        $this->fnlplayers = new ArrayCollection();
        $this->playersteams = new ArrayCollection();
        $this->cupplayers = new ArrayCollection();
        $this->lchplayers = new ArrayCollection();
        $this->ecplayers = new ArrayCollection();
        $this->supercupplayers = new ArrayCollection();
        $this->sbplayers = new ArrayCollection();
        $this->sostavs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmplua(): ?Amplua
    {
        return $this->amplua;
    }

    public function setAmplua(?Amplua $amplua): self
    {
        $this->amplua = $amplua;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBorn(): ?\DateTimeInterface
    {
        return $this->born;
    }

    public function setBorn(\DateTimeInterface $born): self
    {
        $this->born = $born;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getLchGame(): ?int
    {
        return $this->lch_game;
    }

    public function setLchGame(int $lch_game): self
    {
        $this->lch_game = $lch_game;

        return $this;
    }

    public function getLchGoal(): ?int
    {
        return $this->lch_goal;
    }

    public function setLchGoal(int $lch_goal): self
    {
        $this->lch_goal = $lch_goal;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCup(): ?int
    {
        return $this->cup;
    }

    public function setCup(int $cup): self
    {
        $this->cup = $cup;

        return $this;
    }

    public function getSupercup(): ?int
    {
        return $this->supercup;
    }

    public function setSupercup(int $supercup): self
    {
        $this->supercup = $supercup;

        return $this;
    }

    public function getEurocup(): ?int
    {
        return $this->eurocup;
    }

    public function setEurocup(int $eurocup): self
    {
        $this->eurocup = $eurocup;

        return $this;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function setSum(int $sum): self
    {
        $this->sum = $sum;

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
            $rfplmatch->setPlayer($this);
        }

        return $this;
    }

    public function removeRfplmatch(Rfplmatch $rfplmatch): self
    {
        if ($this->rfplmatches->contains($rfplmatch)) {
            $this->rfplmatches->removeElement($rfplmatch);
            // set the owning side to null (unless already changed)
            if ($rfplmatch->getPlayer() === $this) {
                $rfplmatch->setPlayer(null);
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
            $shipplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeShipplayer(Shipplayer $shipplayer): self
    {
        if ($this->shipplayers->contains($shipplayer)) {
            $this->shipplayers->removeElement($shipplayer);
            // set the owning side to null (unless already changed)
            if ($shipplayer->getPlayer() === $this) {
                $shipplayer->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rusplayer[]
     */
    public function getRusplayers(): Collection
    {
        return $this->rusplayers;
    }

    public function addRusplayer(Rusplayer $rusplayer): self
    {
        if (!$this->rusplayers->contains($rusplayer)) {
            $this->rusplayers[] = $rusplayer;
            $rusplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeRusplayer(Rusplayer $rusplayer): self
    {
        if ($this->rusplayers->contains($rusplayer)) {
            $this->rusplayers->removeElement($rusplayer);
            // set the owning side to null (unless already changed)
            if ($rusplayer->getPlayer() === $this) {
                $rusplayer->setPlayer(null);
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
            $gamer->setPlayer($this);
        }

        return $this;
    }

    public function removeGamer(Gamers $gamer): self
    {
        if ($this->gamers->contains($gamer)) {
            $this->gamers->removeElement($gamer);
            // set the owning side to null (unless already changed)
            if ($gamer->getPlayer() === $this) {
                $gamer->setPlayer(null);
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
            $fnlplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeFnlplayer(Fnlplayer $fnlplayer): self
    {
        if ($this->fnlplayers->contains($fnlplayer)) {
            $this->fnlplayers->removeElement($fnlplayer);
            // set the owning side to null (unless already changed)
            if ($fnlplayer->getPlayer() === $this) {
                $fnlplayer->setPlayer(null);
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
            $playersteam->setPlayer($this);
        }

        return $this;
    }

    public function removePlayersteam(Playersteam $playersteam): self
    {
        if ($this->playersteams->contains($playersteam)) {
            $this->playersteams->removeElement($playersteam);
            // set the owning side to null (unless already changed)
            if ($playersteam->getPlayer() === $this) {
                $playersteam->setPlayer(null);
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
            $cupplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeCupplayer(Cupplayer $cupplayer): self
    {
        if ($this->cupplayers->contains($cupplayer)) {
            $this->cupplayers->removeElement($cupplayer);
            // set the owning side to null (unless already changed)
            if ($cupplayer->getPlayer() === $this) {
                $cupplayer->setPlayer(null);
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
            $lchplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeLchplayer(Lchplayer $lchplayer): self
    {
        if ($this->lchplayers->contains($lchplayer)) {
            $this->lchplayers->removeElement($lchplayer);
            // set the owning side to null (unless already changed)
            if ($lchplayer->getPlayer() === $this) {
                $lchplayer->setPlayer(null);
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
            $ecplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeEcplayer(Ecplayer $ecplayer): self
    {
        if ($this->ecplayers->contains($ecplayer)) {
            $this->ecplayers->removeElement($ecplayer);
            // set the owning side to null (unless already changed)
            if ($ecplayer->getPlayer() === $this) {
                $ecplayer->setPlayer(null);
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
            $supercupplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeSupercupplayer(Supercupplayer $supercupplayer): self
    {
        if ($this->supercupplayers->contains($supercupplayer)) {
            $this->supercupplayers->removeElement($supercupplayer);
            // set the owning side to null (unless already changed)
            if ($supercupplayer->getPlayer() === $this) {
                $supercupplayer->setPlayer(null);
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
            $sbplayer->setPlayer($this);
        }

        return $this;
    }

    public function removeSbplayer(Sbplayer $sbplayer): self
    {
        if ($this->sbplayers->contains($sbplayer)) {
            $this->sbplayers->removeElement($sbplayer);
            // set the owning side to null (unless already changed)
            if ($sbplayer->getPlayer() === $this) {
                $sbplayer->setPlayer(null);
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
            $sostav->setPlayer($this);
        }

        return $this;
    }

    public function removeSostav(Sostav $sostav): self
    {
        if ($this->sostavs->contains($sostav)) {
            $this->sostavs->removeElement($sostav);
            // set the owning side to null (unless already changed)
            if ($sostav->getPlayer() === $this) {
                $sostav->setPlayer(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
    }

    public function getInsertdate(): ?\DateTimeInterface
    {
        return $this->insertdate;
    }

    public function setInsertdate(\DateTimeInterface $insertdate): self
    {
        $this->insertdate = $insertdate;

        return $this;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(int $game): self
    {
        $this->game = $game;

        return $this;
    }
}
