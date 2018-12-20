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

    public function __construct()
    {
        $this->cups = new ArrayCollection();
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
}
