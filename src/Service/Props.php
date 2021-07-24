<?php
namespace App\Service;

class Props
{
    private $lastSeason = '2021-22';
    private $sbornieRusYear = 2021;
    private $tops = ['Англия', 'Испания', 'Италия', 'Германия', 'Франция'];

    public function getLastSeason(): ?string
    {
      return $this->lastSeason;
    }

    public function getTops(): array
    {
        return $this->tops;
    }

    public function getSbornieRusYear(): int
    {
        return $this->sbornieRusYear;
    }
}
