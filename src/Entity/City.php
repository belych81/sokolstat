<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
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
     * @ORM\OneToMany(targetEntity="App\Entity\Mundial", mappedBy="city")
     */
    private $mundials;

    /**
     * @ORM\OneToMany(targetEntity=Rfplmatch::class, mappedBy="city")
     */
    private $rfplmatches;

    /**
     * @ORM\OneToMany(targetEntity=Ecsostav::class, mappedBy="city")
     */
    private $ecsostavs;

    public function __construct()
    {
        $this->mundials = new ArrayCollection();
        $this->rfplmatches = new ArrayCollection();
        $this->ecsostavs = new ArrayCollection();
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
}
