<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $translit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
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
      return $this->name;
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
}
