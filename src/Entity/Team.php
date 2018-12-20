<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cup", mappedBy="team")
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

    public function getTranslit(): ?string
    {
        return $this->translit;
    }

    public function setTranslit(string $translit): self
    {
        $this->translit = $translit;

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
            $cup->setTeam($this);
        }

        return $this;
    }

    public function removeCup(Cup $cup): self
    {
        if ($this->cups->contains($cup)) {
            $this->cups->removeElement($cup);
            // set the owning side to null (unless already changed)
            if ($cup->getTeam() === $this) {
                $cup->setTeam(null);
            }
        }

        return $this;
    }
}
