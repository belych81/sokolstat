<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RefereeRepository")
 */
class Referee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="referees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mundial", mappedBy="referee")
     */
    private $mundials;

    /**
     * @ORM\OneToMany(targetEntity=Rfplmatch::class, mappedBy="referee")
     */
    private $rfplmatches;

    /**
     * @ORM\OneToMany(targetEntity=Ecsostav::class, mappedBy="referee")
     */
    private $ecsostavs;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="referee")
     */
    private $games;

    public function __construct()
    {
        $this->mundials = new ArrayCollection();
        $this->rfplmatches = new ArrayCollection();
        $this->ecsostavs = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $mundial->setReferee($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getReferee() === $this) {
                $mundial->setReferee(null);
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
            $rfplmatch->setReferee($this);
        }

        return $this;
    }

    public function removeRfplmatch(Rfplmatch $rfplmatch): self
    {
        if ($this->rfplmatches->removeElement($rfplmatch)) {
            // set the owning side to null (unless already changed)
            if ($rfplmatch->getReferee() === $this) {
                $rfplmatch->setReferee(null);
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
            $ecsostav->setReferee($this);
        }

        return $this;
    }

    public function removeEcsostav(Ecsostav $ecsostav): self
    {
        if ($this->ecsostavs->removeElement($ecsostav)) {
            // set the owning side to null (unless already changed)
            if ($ecsostav->getReferee() === $this) {
                $ecsostav->setReferee(null);
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
            $game->setReferee($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getReferee() === $this) {
                $game->setReferee(null);
            }
        }

        return $this;
    }
}
