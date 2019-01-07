<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StadiaRepository")
 */
class Stadia
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
    private $alias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cup", mappedBy="stadia")
     */
    private $cups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eurocup", mappedBy="stadia")
     */
    private $eurocups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NationCup", mappedBy="stadia")
     */
    private $nationCups;

    public function __construct()
    {
        $this->cups = new ArrayCollection();
        $this->eurocups = new ArrayCollection();
        $this->nationCups = new ArrayCollection();
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
}
