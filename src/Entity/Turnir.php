<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TurnirRepository")
 */
class Turnir
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
     * @ORM\OneToMany(targetEntity="App\Entity\Eurocup", mappedBy="turnir")
     */
    private $eurocups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ectable", mappedBy="turnir")
     */
    private $ectables;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $russianalias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ecplayer", mappedBy="turnir")
     */
    private $ecplayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mundial", mappedBy="turnir")
     */
    private $mundials;

    public function __construct()
    {
        $this->eurocups = new ArrayCollection();
        $this->ectables = new ArrayCollection();
        $this->ecplayers = new ArrayCollection();
        $this->mundials = new ArrayCollection();
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
            $eurocup->setTurnir($this);
        }

        return $this;
    }

    public function removeEurocup(Eurocup $eurocup): self
    {
        if ($this->eurocups->contains($eurocup)) {
            $this->eurocups->removeElement($eurocup);
            // set the owning side to null (unless already changed)
            if ($eurocup->getTurnir() === $this) {
                $eurocup->setTurnir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ectable[]
     */
    public function getEctables(): Collection
    {
        return $this->ectables;
    }

    public function addEctable(Ectable $ectable): self
    {
        if (!$this->ectables->contains($ectable)) {
            $this->ectables[] = $ectable;
            $ectable->setTurnir($this);
        }

        return $this;
    }

    public function removeEctable(Ectable $ectable): self
    {
        if ($this->ectables->contains($ectable)) {
            $this->ectables->removeElement($ectable);
            // set the owning side to null (unless already changed)
            if ($ectable->getTurnir() === $this) {
                $ectable->setTurnir(null);
            }
        }

        return $this;
    }

    public function getRussianalias(): ?string
    {
        return $this->russianalias;
    }

    public function setRussianalias(string $russianalias): self
    {
        $this->russianalias = $russianalias;

        return $this;
    }

    public function __toString(): ?string
    {
      return $this->name;
    }

    /**
     * @return Collection|Ecplayer[]
     */
    public function getEcplayers(): Collection
    {
        return $this->ecplayers;
    }

    public function addEcplayer(Ecplayer $ecplayer): self
    {
        if (!$this->ecplayers->contains($ecplayer)) {
            $this->ecplayers[] = $ecplayer;
            $ecplayer->setTurnir($this);
        }

        return $this;
    }

    public function removeEcplayer(Ecplayer $ecplayer): self
    {
        if ($this->ecplayers->contains($ecplayer)) {
            $this->ecplayers->removeElement($ecplayer);
            // set the owning side to null (unless already changed)
            if ($ecplayer->getTurnir() === $this) {
                $ecplayer->setTurnir(null);
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
            $mundial->setTurnir($this);
        }

        return $this;
    }

    public function removeMundial(Mundial $mundial): self
    {
        if ($this->mundials->contains($mundial)) {
            $this->mundials->removeElement($mundial);
            // set the owning side to null (unless already changed)
            if ($mundial->getTurnir() === $this) {
                $mundial->setTurnir(null);
            }
        }

        return $this;
    }

}
