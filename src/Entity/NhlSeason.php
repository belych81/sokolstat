<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\NhlSeasonRepository::class)]
class NhlSeason
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlReg::class, mappedBy: 'season')]
    private $nhlRegs;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlPlayOff::class, mappedBy: 'season')]
    private $nhlPlayOffs;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlMatch::class, mappedBy: 'season')]
    private $matches;

    public function __construct()
    {
        $this->nhlRegs = new ArrayCollection();
        $this->nhlPlayOffs = new ArrayCollection();
        $this->matches = new ArrayCollection();
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
     * @return Collection|NhlReg[]
     */
    public function getNhlRegs(): Collection
    {
        return $this->nhlRegs;
    }

    public function addNhlReg(NhlReg $nhlReg): self
    {
        if (!$this->nhlRegs->contains($nhlReg)) {
            $this->nhlRegs[] = $nhlReg;
            $nhlReg->setSeason($this);
        }

        return $this;
    }

    public function removeNhlReg(NhlReg $nhlReg): self
    {
        if ($this->nhlRegs->contains($nhlReg)) {
            $this->nhlRegs->removeElement($nhlReg);
            // set the owning side to null (unless already changed)
            if ($nhlReg->getSeason() === $this) {
                $nhlReg->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NhlPlayOff[]
     */
    public function getNhlPlayOffs(): Collection
    {
        return $this->nhlPlayOffs;
    }

    public function addNhlPlayOff(NhlPlayOff $nhlPlayOff): self
    {
        if (!$this->nhlPlayOffs->contains($nhlPlayOff)) {
            $this->nhlPlayOffs[] = $nhlPlayOff;
            $nhlPlayOff->setSeason($this);
        }

        return $this;
    }

    public function removeNhlPlayOff(NhlPlayOff $nhlPlayOff): self
    {
        if ($this->nhlPlayOffs->contains($nhlPlayOff)) {
            $this->nhlPlayOffs->removeElement($nhlPlayOff);
            // set the owning side to null (unless already changed)
            if ($nhlPlayOff->getSeason() === $this) {
                $nhlPlayOff->setSeason(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
    }

    /**
     * @return Collection|NhlMatch[]
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(NhlMatch $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setSeason($this);
        }

        return $this;
    }

    public function removeMatch(NhlMatch $match): self
    {
        if ($this->matches->contains($match)) {
            $this->matches->removeElement($match);
            // set the owning side to null (unless already changed)
            if ($match->getSeason() === $this) {
                $match->setSeason(null);
            }
        }

        return $this;
    }
}
