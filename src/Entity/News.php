<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: \App\Repository\NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $translit;

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\Column(type: 'text')]
    private $text;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $active;

    #[ORM\OneToOne(targetEntity: Period::class, mappedBy: 'news', cascade: ['persist', 'remove'])]
    private $period;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function computeTranslit(SluggerInterface $slugger)
    {
        if (!$this->translit || '-' === $this->translit) {
            $this->translit = (string) $slugger->slug((string) $this)->lower();
        }
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    #[ORM\PrePersist]
    public function setDataValue()
    {
        $this->data = new \DateTime();
    }

    public function __toString()
    {
      return $this->title;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        // unset the owning side of the relation if necessary
        if ($period === null && $this->period !== null) {
            $this->period->setNews(null);
        }

        // set the owning side of the relation if necessary
        if ($period !== null && $period->getNews() !== $this) {
            $period->setNews($this);
        }

        $this->period = $period;

        return $this;
    }
}
