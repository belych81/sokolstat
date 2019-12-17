<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlConfRepository")
 */
class NhlConf
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
     * @ORM\OneToMany(targetEntity="App\Entity\NhlDivision", mappedBy="conf")
     */
    private $nhlDivisions;

    public function __construct()
    {
        $this->nhlDivisions = new ArrayCollection();
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
     * @return Collection|NhlDivision[]
     */
    public function getNhlDivisions(): Collection
    {
        return $this->nhlDivisions;
    }

    public function addNhlDivision(NhlDivision $nhlDivision): self
    {
        if (!$this->nhlDivisions->contains($nhlDivision)) {
            $this->nhlDivisions[] = $nhlDivision;
            $nhlDivision->setConf($this);
        }

        return $this;
    }

    public function removeNhlDivision(NhlDivision $nhlDivision): self
    {
        if ($this->nhlDivisions->contains($nhlDivision)) {
            $this->nhlDivisions->removeElement($nhlDivision);
            // set the owning side to null (unless already changed)
            if ($nhlDivision->getConf() === $this) {
                $nhlDivision->setConf(null);
            }
        }

        return $this;
    }
}
