<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlStadiaRepository")
 */
class NhlStadia
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
     * @ORM\OneToMany(targetEntity="App\Entity\NhlMatch", mappedBy="stadia")
     */
    private $nhlMatches;

    public function __construct()
    {
        $this->nhlMatches = new ArrayCollection();
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

    /**
     * @return Collection|NhlMatch[]
     */
    public function getNhlMatches(): Collection
    {
        return $this->nhlMatches;
    }

    public function addNhlMatch(NhlMatch $nhlMatch): self
    {
        if (!$this->nhlMatches->contains($nhlMatch)) {
            $this->nhlMatches[] = $nhlMatch;
            $nhlMatch->setStadia($this);
        }

        return $this;
    }

    public function removeNhlMatch(NhlMatch $nhlMatch): self
    {
        if ($this->nhlMatches->contains($nhlMatch)) {
            $this->nhlMatches->removeElement($nhlMatch);
            // set the owning side to null (unless already changed)
            if ($nhlMatch->getStadia() === $this) {
                $nhlMatch->setStadia(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
      return $this->name;
    }
}
