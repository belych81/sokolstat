<?php

namespace App\Entity;

use App\Repository\AchieveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\AchieveRepository::class)]
class Achieve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'achieve', targetEntity: AchieveItems::class)]
    private Collection $achieveItems;

    public function __construct()
    {
        $this->achieveItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, AchieveItems>
     */
    public function getAchieveItems(): Collection
    {
        return $this->achieveItems;
    }

    public function addAchieveItem(AchieveItems $achieveItem): static
    {
        if (!$this->achieveItems->contains($achieveItem)) {
            $this->achieveItems->add($achieveItem);
            $achieveItem->setAchieve($this);
        }

        return $this;
    }

    public function removeAchieveItem(AchieveItems $achieveItem): static
    {
        if ($this->achieveItems->removeElement($achieveItem)) {
            // set the owning side to null (unless already changed)
            if ($achieveItem->getAchieve() === $this) {
                $achieveItem->setAchieve(null);
            }
        }

        return $this;
    }
}
