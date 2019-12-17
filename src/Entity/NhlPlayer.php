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
    private $goalReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalSum = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlReg", mappedBy="player")
     */
    private $nhlRegs;

    /**
     * @ORM\Column(type="integer")
     */
    private $assistReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $assistPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $assistSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $scoreReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $scorePlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $scoreSum = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="nhlPlayers")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Amplua", inversedBy="nhlPlayers")
     */
    private $amplua;

    /**
     * @ORM\Column(type="date")
     */
    private $born;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $translit;

    /**
     * @ORM\Column(type="integer")
     */
    private $gameReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $gamePlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $gameSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $missedReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $missedPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $missedSum = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $zeroReg = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $zeroPlayOff = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $zeroSum = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NhlPlayersTeam", mappedBy="player")
     */
    private $nhlPlayersTeams;

    /**
     * @ORM\Column(type="datetime")
     */
    private $insertdate;

    public function __construct()
    {
        $this->nhlRegs = new ArrayCollection();
        $this->nhlPlayOffs = new ArrayCollection();
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

    public function getAssistReg(): ?int
    {
        return $this->assistReg;
    }

    public function setAssistReg(int $assistReg): self
    {
        $this->assistReg = $assistReg;

        return $this;
    }

    public function getAssistPlayOff(): ?int
    {
        return $this->assistPlayOff;
    }

    public function setAssistPlayOff(int $assistPlayOff): self
    {
        $this->assistPlayOff = $assistPlayOff;

        return $this;
    }

    public function getAssistSum(): ?int
    {
        return $this->assistSum;
    }

    public function setAssistSum(int $assistSum): self
    {
        $this->assistSum = $assistSum;

        return $this;
    }

    public function getScoreReg(): ?int
    {
        return $this->scoreReg;
    }

    public function setScoreReg(int $scoreReg): self
    {
        $this->scoreReg = $scoreReg;

        return $this;
    }

    public function getScorePlayOff(): ?int
    {
        return $this->scorePlayOff;
    }

    public function setScorePlayOff(int $scorePlayOff): self
    {
        $this->scorePlayOff = $scorePlayOff;

        return $this;
    }

    public function getScoreSum(): ?int
    {
        return $this->scoreSum;
    }

    public function setScoreSum(int $scoreSum): self
    {
        $this->scoreSum = $scoreSum;

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

    public function getAmplua(): ?Amplua
    {
        return $this->amplua;
    }

    public function setAmplua(?Amplua $amplua): self
    {
        $this->amplua = $amplua;

        return $this;
    }

    public function getBorn(): ?\DateTimeInterface
    {
        return $this->born;
    }

    public function setBorn(\DateTimeInterface $born): self
    {
        $this->born = $born;

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

    public function getGameReg(): ?int
    {
        return $this->gameReg;
    }

    public function setGameReg(int $gameReg): self
    {
        $this->gameReg = $gameReg;

        return $this;
    }

    public function getGamePlayOff(): ?int
    {
        return $this->gamePlayOff;
    }

    public function setGamePlayOff(int $gamePlayOff): self
    {
        $this->gamePlayOff = $gamePlayOff;

        return $this;
    }

    public function getGameSum(): ?int
    {
        return $this->gameSum;
    }

    public function setGameSum(int $gameSum): self
    {
        $this->gameSum = $gameSum;

        return $this;
    }

    public function getMissedReg(): ?int
    {
        return $this->missedReg;
    }

    public function setMissedReg(int $missedReg): self
    {
        $this->missedReg = $missedReg;

        return $this;
    }

    public function getMissedPlayOff(): ?int
    {
        return $this->missedPlayOff;
    }

    public function setMissedPlayOff(int $missedPlayOff): self
    {
        $this->missedPlayOff = $missedPlayOff;

        return $this;
    }

    public function getMissedSum(): ?int
    {
        return $this->missedSum;
    }

    public function setMissedSum(int $missedSum): self
    {
        $this->missedSum = $missedSum;

        return $this;
    }

    public function getZeroReg(): ?int
    {
        return $this->zeroReg;
    }

    public function setZeroReg(int $zeroReg): self
    {
        $this->zeroReg = $zeroReg;

        return $this;
    }

    public function getZeroPlayOff(): ?int
    {
        return $this->zeroPlayOff;
    }

    public function setZeroPlayOff(int $zeroPlayOff): self
    {
        $this->zeroPlayOff = $zeroPlayOff;

        return $this;
    }

    public function getZeroSum(): ?int
    {
        return $this->zeroSum;
    }

    public function setZeroSum(int $zeroSum): self
    {
        $this->zeroSum = $zeroSum;

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
            $nhlPlayersTeam->setPlayer($this);
        }

        return $this;
    }

    public function removeNhlPlayersTeam(NhlPlayersTeam $nhlPlayersTeam): self
    {
        if ($this->nhlPlayersTeams->contains($nhlPlayersTeam)) {
            $this->nhlPlayersTeams->removeElement($nhlPlayersTeam);
            // set the owning side to null (unless already changed)
            if ($nhlPlayersTeam->getPlayer() === $this) {
                $nhlPlayersTeam->setPlayer(null);
            }
        }

        return $this;
    }

    public function getInsertdate(): ?\DateTimeInterface
    {
        return $this->insertdate;
    }

    public function setInsertdate(\DateTimeInterface $insertdate): self
    {
        $this->insertdate = $insertdate;

        return $this;
    }
}
