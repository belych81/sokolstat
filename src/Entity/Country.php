<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $translit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="country")
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tour", mappedBy="country")
     */
    private $tours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="country")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationSupercup", mappedBy="country")
     */
    private $nationSupercups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationCup", mappedBy="country")
     */
    private $nationCups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shiptable", mappedBy="country")
     */
    private $shiptables;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mundial", mappedBy="country")
     */
    private $mundials;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Referee", mappedBy="country")
     */
    private $referees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sostav", mappedBy="country")
     */
    private $sostavs;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->tours = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->nationSupercups = new ArrayCollection();
        $this->nationCups = new ArrayCollection();
        $this->shiptables = new ArrayCollection();
        $this->mundials = new ArrayCollection();
        $this->referees = new ArrayCollection();
        $this->sostavs = new ArrayCollection();
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

    public function setTranslit(?string $translit): self
    {
        $this->translit = $translit;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setCountry($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getCountry() === $this) {
                $team->setCountry(null);
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
            $tour->setCountry($this);
        }

        return $this;
    }

    public function removeTour(Tour $tour): self
    {
        if ($this->tours->contains($tour)) {
            $this->tours->removeElement($tour);
            // set the owning side to null (unless already changed)
            if ($tour->getCountry() === $this) {
                $tour->setCountry(null);
            }
        }

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
            $player->setCountry($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getCountry() === $this) {
                $player->setCountry(null);
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
            $nationSupercup->setCountry($this);
        }

        return $this;
    }

    public function removeNationSupercup(NationSupercup $nationSupercup): self
    {
        if ($this->nationSupercups->contains($nationSupercup)) {
            $this->nationSupercups->removeElement($nationSupercup);
            // set the owning side to null (unless already changed)
            if ($nationSupercup->getCountry() === $this) {
                $nationSupercup->setCountry(null);
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
            $nationCup->setCountry($this);
        }

        return $this;
    }

    public function removeNationCup(NationCup $nationCup): self
    {
        if ($this->nationCups->contains($nationCup)) {
            $this->nationCups->removeElement($nationCup);
            // set the owning side to null (unless already changed)
            if ($nationCup->getCountry() === $this) {
                $nationCup->setCountry(null);
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
            $shiptable->setCountry($this);
        }

        return $this;
    }

    public function removeShiptable(Shiptable $shiptable): self
    {
        if ($this->shiptables->contains($shiptable)) {
            $this->shiptables->removeElement($shiptable);
            // set the owning side to null (unless already changed)
            if ($shiptable->getCountry() === $this) {
                $shiptable->setCountry(null);
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
            $mundial->setCountry($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getCountry() === $this) {
                $mundial->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Referee[]
     */
    public function getReferees(): Collection
    {
        return $this->referees;
    }

    public function addReferee(Referee $referee): self
    {
        if (!$this->referees->contains($referee)) {
            $this->referees[] = $referee;
            $referee->setCountry($this);
        }

        return $this;
    }

    public function removeReferee(Referee $referee): self
    {
        if ($this->referees->contains($referee)) {
            $this->referees->removeElement($referee);
            // set the owning side to null (unless already changed)
            if ($referee->getCountry() === $this) {
                $referee->setCountry(null);
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
            $sostav->setCountry($this);
        }

        return $this;
    }

    public function removeSostav(Sostav $sostav): self
    {
        if ($this->sostavs->contains($sostav)) {
            $this->sostavs->removeElement($sostav);
            // set the owning side to null (unless already changed)
            if ($sostav->getCountry() === $this) {
                $sostav->setCountry(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return (string)$this->name;
    }
}
