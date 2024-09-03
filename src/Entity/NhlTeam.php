<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\NhlTeamRepository::class)]
class NhlTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlReg::class, mappedBy: 'team')]
    private $nhlRegs;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlPlayOff::class, mappedBy: 'team')]
    private $nhlPlayOffs;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlMatch::class, mappedBy: 'team')]
    private $nhlMatches;

    #[ORM\OneToMany(targetEntity: \App\Entity\NflMatch::class, mappedBy: 'team')]
    private $nflMatches;

    #[ORM\Column(type: 'string', length: 255)]
    private $translit;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlTable::class, mappedBy: 'team')]
    private $nhlTables;

    #[ORM\Column(type: 'integer')]
    private $winsreg = 0;

    #[ORM\Column(type: 'integer')]
    private $nichreg = 0;

    #[ORM\Column(type: 'integer')]
    private $porazhreg = 0;

    #[ORM\Column(type: 'integer')]
    private $mzreg = 0;

    #[ORM\Column(type: 'integer')]
    private $mpreg = 0;

    #[ORM\Column(type: 'integer')]
    private $scorereg = 0;

    #[ORM\Column(type: 'integer')]
    private $winspo = 0;

    #[ORM\Column(type: 'integer')]
    private $nichpo = 0;

    #[ORM\Column(type: 'integer')]
    private $porazhpo = 0;

    #[ORM\Column(type: 'integer')]
    private $mzpo = 0;

    #[ORM\Column(type: 'integer')]
    private $mppo = 0;

    #[ORM\Column(type: 'integer')]
    private $scorepo = 0;

    #[ORM\Column(type: 'integer')]
    private $wins = 0;

    #[ORM\Column(type: 'integer')]
    private $nich = 0;

    #[ORM\Column(type: 'integer')]
    private $porazh = 0;

    #[ORM\Column(type: 'integer')]
    private $mz = 0;

    #[ORM\Column(type: 'integer')]
    private $mp = 0;

    #[ORM\Column(type: 'integer')]
    private $score = 0;

    #[ORM\Column(type: 'integer')]
    private $gamereg = 0;

    #[ORM\Column(type: 'integer')]
    private $gamepo = 0;

    #[ORM\Column(type: 'integer')]
    private $game = 0;

    #[ORM\OneToMany(targetEntity: \App\Entity\NhlPlayersTeam::class, mappedBy: 'team')]
    private $nhlPlayersTeams;

    #[ORM\Column(type: 'string', length: 255)]
    private $image = '';

    #[ORM\Column(type: 'string', length: 255)]
    private $image2 = '';

    #[ORM\Column(type: 'integer')]
    private ?int $matches = 0;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color4 = null;

    public function __construct()
    {
        $this->nhlRegs = new ArrayCollection();
        $this->nhlPlayOffs = new ArrayCollection();
        $this->nhlMatches = new ArrayCollection();
        $this->nflMatches = new ArrayCollection();
        $this->nhlTables = new ArrayCollection();
        $this->nhlPlayersTeams = new ArrayCollection();
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
            $nhlReg->setTeam($this);
        }

        return $this;
    }

    public function removeNhlReg(NhlReg $nhlReg): self
    {
        if ($this->nhlRegs->contains($nhlReg)) {
            $this->nhlRegs->removeElement($nhlReg);
            // set the owning side to null (unless already changed)
            if ($nhlReg->getTeam() === $this) {
                $nhlReg->setTeam(null);
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
            $nhlPlayOff->setTeam($this);
        }

        return $this;
    }

    public function removeNhlPlayOff(NhlPlayOff $nhlPlayOff): self
    {
        if ($this->nhlPlayOffs->contains($nhlPlayOff)) {
            $this->nhlPlayOffs->removeElement($nhlPlayOff);
            // set the owning side to null (unless already changed)
            if ($nhlPlayOff->getTeam() === $this) {
                $nhlPlayOff->setTeam(null);
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
    public function getNhlMatches(): Collection
    {
        return $this->nhlMatches;
    }

    public function addNhlMatch(NhlMatch $nhlMatch): self
    {
        if (!$this->nhlMatches->contains($nhlMatch)) {
            $this->nhlMatches[] = $nhlMatch;
            $nhlMatch->setTeam($this);
        }

        return $this;
    }

    public function removeNhlMatch(NhlMatch $nhlMatch): self
    {
        if ($this->nhlMatches->contains($nhlMatch)) {
            $this->nhlMatches->removeElement($nhlMatch);
            // set the owning side to null (unless already changed)
            if ($nhlMatch->getTeam() === $this) {
                $nhlMatch->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NflMatch[]
     */
    public function getNflMatches(): Collection
    {
        return $this->nflMatches;
    }

    public function addNflMatch(NflMatch $nflMatch): self
    {
        if (!$this->nflMatches->contains($nflMatch)) {
            $this->nflMatches[] = $nflMatch;
            $nflMatch->setTeam($this);
        }

        return $this;
    }

    public function removeNflMatch(NflMatch $nflMatch): self
    {
        if ($this->nflMatches->contains($nflMatch)) {
            $this->nflMatches->removeElement($nflMatch);
            // set the owning side to null (unless already changed)
            if ($nflMatch->getTeam() === $this) {
                $nflMatch->setTeam(null);
            }
        }

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
            $nhlTable->setTeam($this);
        }

        return $this;
    }

    public function removeNhlTable(NhlTable $nhlTable): self
    {
        if ($this->nhlTables->contains($nhlTable)) {
            $this->nhlTables->removeElement($nhlTable);
            // set the owning side to null (unless already changed)
            if ($nhlTable->getTeam() === $this) {
                $nhlTable->setTeam(null);
            }
        }

        return $this;
    }

    public function getWinsreg(): ?int
    {
        return $this->winsreg;
    }

    public function setWinsreg(int $winsreg): self
    {
        $this->winsreg = $winsreg;

        return $this;
    }

    public function getNichreg(): ?int
    {
        return $this->nichreg;
    }

    public function setNichreg(int $nichreg): self
    {
        $this->nichreg = $nichreg;

        return $this;
    }

    public function getPorazhreg(): ?int
    {
        return $this->porazhreg;
    }

    public function setPorazhreg(int $porazhreg): self
    {
        $this->porazhreg = $porazhreg;

        return $this;
    }

    public function getMzreg(): ?int
    {
        return $this->mzreg;
    }

    public function setMzreg(int $mzreg): self
    {
        $this->mzreg = $mzreg;

        return $this;
    }

    public function getMpreg(): ?int
    {
        return $this->mpreg;
    }

    public function setMpreg(int $mpreg): self
    {
        $this->mpreg = $mpreg;

        return $this;
    }

    public function getScorereg(): ?int
    {
        return $this->scorereg;
    }

    public function setScorereg(int $scorereg): self
    {
        $this->scorereg = $scorereg;

        return $this;
    }

    public function getWinspo(): ?int
    {
        return $this->winspo;
    }

    public function setWinspo(int $winspo): self
    {
        $this->winspo = $winspo;

        return $this;
    }

    public function getNichpo(): ?int
    {
        return $this->nichpo;
    }

    public function setNichpo(int $nichpo): self
    {
        $this->nichpo = $nichpo;

        return $this;
    }

    public function getPorazhpo(): ?int
    {
        return $this->porazhpo;
    }

    public function setPorazhpo(int $porazhpo): self
    {
        $this->porazhpo = $porazhpo;

        return $this;
    }

    public function getMzpo(): ?int
    {
        return $this->mzpo;
    }

    public function setMzpo(int $mzpo): self
    {
        $this->mzpo = $mzpo;

        return $this;
    }

    public function getMppo(): ?int
    {
        return $this->mppo;
    }

    public function setMppo(int $mppo): self
    {
        $this->mppo = $mppo;

        return $this;
    }

    public function getScorepo(): ?int
    {
        return $this->scorepo;
    }

    public function setScorepo(int $scorepo): self
    {
        $this->scorepo = $scorepo;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getNich(): ?int
    {
        return $this->nich;
    }

    public function setNich(int $nich): self
    {
        $this->nich = $nich;

        return $this;
    }

    public function getPorazh(): ?int
    {
        return $this->porazh;
    }

    public function setPorazh(int $porazh): self
    {
        $this->porazh = $porazh;

        return $this;
    }

    public function getMz(): ?int
    {
        return $this->mz;
    }

    public function setMz(int $mz): self
    {
        $this->mz = $mz;

        return $this;
    }

    public function getMp(): ?int
    {
        return $this->mp;
    }

    public function setMp(int $mp): self
    {
        $this->mp = $mp;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getGamereg(): ?int
    {
        return $this->gamereg;
    }

    public function setGamereg(int $gamereg): self
    {
        $this->gamereg = $gamereg;

        return $this;
    }

    public function getGamepo(): ?int
    {
        return $this->gamepo;
    }

    public function setGamepo(int $gamepo): self
    {
        $this->gamepo = $gamepo;

        return $this;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(int $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection|NhlPlayersTeam[]
     */
    public function getNhlPlayersTeams(): Collection
    {
        return $this->nhlPlayersTeams;
    }

    public function addNhlPlayersTeam(NhlPlayersTeam $nhlPlayersTeam): self
    {
        if (!$this->nhlPlayersTeams->contains($nhlPlayersTeam)) {
            $this->nhlPlayersTeams[] = $nhlPlayersTeam;
            $nhlPlayersTeam->setTeam($this);
        }

        return $this;
    }

    public function removeNhlPlayersTeam(NhlPlayersTeam $nhlPlayersTeam): self
    {
        if ($this->nhlPlayersTeams->contains($nhlPlayersTeam)) {
            $this->nhlPlayersTeams->removeElement($nhlPlayersTeam);
            // set the owning side to null (unless already changed)
            if ($nhlPlayersTeam->getTeam() === $this) {
                $nhlPlayersTeam->setTeam(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getMatches(): ?int
    {
        return $this->matches;
    }

    public function setMatches(?int $matches): static
    {
        $this->matches = $matches;

        return $this;
    }

    public function getColor1(): ?string
    {
        return $this->color1;
    }

    public function setColor1(?string $color1): static
    {
        $this->color1 = $color1;

        return $this;
    }

    public function getColor2(): ?string
    {
        return $this->color2;
    }

    public function setColor2(?string $color2): static
    {
        $this->color2 = $color2;

        return $this;
    }

    public function getColor3(): ?string
    {
        return $this->color3;
    }

    public function setColor3(?string $color3): static
    {
        $this->color3 = $color3;

        return $this;
    }

    public function getColor4(): ?string
    {
        return $this->color4;
    }

    public function setColor4(?string $color4): static
    {
        $this->color4 = $color4;

        return $this;
    }
}
