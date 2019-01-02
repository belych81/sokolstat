<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlPlayerRepository")
 */
class NhlPlayer
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
     * @ORM\Column(type="integer")
     */
    private $goalReg;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalPlayOff;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalSum;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlReg", mappedBy="player")
     */
    private $nhlRegs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlPlayOff", mappedBy="player")
     */
    private $nhlPlayOffs;

    public function __construct()
    {
        $this->nhlRegs = new ArrayCollection();
        $this->nhlPlayOffs = new ArrayCollection();
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

    public function getGoalReg(): ?int
    {
        return $this->goalReg;
    }

    public function setGoalReg(int $goalReg): self
    {
        $this->goalReg = $goalReg;

        return $this;
    }

    public function getGoalPlayOff(): ?int
    {
        return $this->goalPlayOff;
    }

    public function setGoalPlayOff(int $goalPlayOff): self
    {
        $this->goalPlayOff = $goalPlayOff;

        return $this;
    }

    public function getGoalSum(): ?int
    {
        return $this->goalSum;
    }

    public function setGoalSum(int $goalSum): self
    {
        $this->goalSum = $goalSum;

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
            $nhlReg->setPlayer($this);
        }

        return $this;
    }

    public function removeNhlReg(NhlReg $nhlReg): self
    {
        if ($this->nhlRegs->contains($nhlReg)) {
            $this->nhlRegs->removeElement($nhlReg);
            // set the owning side to null (unless already changed)
            if ($nhlReg->getPlayer() === $this) {
                $nhlReg->setPlayer(null);
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
            $nhlPlayOff->setPlayer($this);
        }

        return $this;
    }

    public function removeNhlPlayOff(NhlPlayOff $nhlPlayOff): self
    {
        if ($this->nhlPlayOffs->contains($nhlPlayOff)) {
            $this->nhlPlayOffs->removeElement($nhlPlayOff);
            // set the owning side to null (unless already changed)
            if ($nhlPlayOff->getPlayer() === $this) {
                $nhlPlayOff->setPlayer(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
    }
}
