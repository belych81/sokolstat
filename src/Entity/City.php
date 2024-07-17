<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: \App\Entity\Mundial::class, mappedBy: 'city')]
    private $mundials;

    #[ORM\OneToMany(targetEntity: Rfplmatch::class, mappedBy: 'city')]
    private $rfplmatches;

    #[ORM\OneToMany(targetEntity: Ecsostav::class, mappedBy: 'city')]
    private $ecsostavs;

    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'city')]
    private $games;

    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'city')]
    private $teams;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'cities')]
    private $country;

    public function __construct()
    {
        $this->mundials = new ArrayCollection();
        $this->rfplmatches = new ArrayCollection();
        $this->ecsostavs = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->teams = new ArrayCollection();
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
            $mundial->setCity($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getCity() === $this) {
                $mundial->setCity(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
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
            $rfplmatch->setCity($this);
        }

        return $this;
    }

    public function removeRfplmatch(Rfplmatch $rfplmatch): self
    {
        if ($this->rfplmatches->removeElement($rfplmatch)) {
            // set the owning side to null (unless already changed)
            if ($rfplmatch->getCity() === $this) {
                $rfplmatch->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ecsostav[]
     */
    public function getEcsostavs(): Collection
    {
        return $this->ecsostavs;
    }

    public function addEcsostav(Ecsostav $ecsostav): self
    {
        if (!$this->ecsostavs->contains($ecsostav)) {
            $this->ecsostavs[] = $ecsostav;
            $ecsostav->setCity($this);
        }

        return $this;
    }

    public function removeEcsostav(Ecsostav $ecsostav): self
    {
        if ($this->ecsostavs->removeElement($ecsostav)) {
            // set the owning side to null (unless already changed)
            if ($ecsostav->getCity() === $this) {
                $ecsostav->setCity(null);
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
            $game->setCity($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getCity() === $this) {
                $game->setCity(null);
            }
        }

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
            $team->setCity($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getCity() === $this) {
                $team->setCity(null);
            }
        }

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
}
