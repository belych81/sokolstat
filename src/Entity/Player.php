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
    private $goal;

    /**
     * @ORM\Column(type="integer")
     */
    private $lch_game;

    /**
     * @ORM\Column(type="integer")
     */
    private $lch_goal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $translit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $cup;

    /**
     * @ORM\Column(type="integer")
     */
    private $supercup;

    /**
     * @ORM\Column(type="integer")
     */
    private $eurocup;

    /**
     * @ORM\Column(type="integer")
     */
    private $sum;

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

    public function __construct()
    {
        $this->rfplmatches = new ArrayCollection();
        $this->shipplayers = new ArrayCollection();
        $this->rusplayers = new ArrayCollection();
        $this->gamers = new ArrayCollection();
        $this->fnlplayers = new ArrayCollection();
        $this->playersteams = new ArrayCollection();
        $this->cupplayers = new ArrayCollection();
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
}
