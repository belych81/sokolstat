<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NhlDivisionRepository")
 */
class NhlDivision
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
     * @ORM\ManyToOne(targetEntity="App\Entity\NhlConf", inversedBy="nhlDivisions")
     */
    private $conf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlTable", mappedBy="division")
     */
    private $nhlTables;

    public function __construct()
    {
        $this->nhlTables = new ArrayCollection();
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

    public function getConf(): ?NhlConf
    {
        return $this->conf;
    }

    public function setConf(?NhlConf $conf): self
    {
        $this->conf = $conf;

        return $this;
    }

    /**
     * @return Collection|NhlTable[]
     */
    public function getNhlTables(): Collection
    {
        return $this->nhlTables;
    }

    public function addNhlTable(NhlTable $nhlTable): self
    {
        if (!$this->nhlTables->contains($nhlTable)) {
            $this->nhlTables[] = $nhlTable;
            $nhlTable->setDivision($this);
        }

        return $this;
    }

    public function removeNhlTable(NhlTable $nhlTable): self
    {
        if ($this->nhlTables->contains($nhlTable)) {
            $this->nhlTables->removeElement($nhlTable);
            // set the owning side to null (unless already changed)
            if ($nhlTable->getDivision() === $this) {
                $nhlTable->setDivision(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
      return $this->name;
    }
}
