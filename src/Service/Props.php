<?php
namespace App\Service;

class Props
{
    private $lastSeason = '2020-21';
    private $tops = ['Англия', 'Испания', 'Италия', 'Германия', 'Франция'];

    public function getLastSeason(): ?string
    {
      return $this->lastSeason;
    }

    public function getTops(): array
    {
        return $this->tops;
    }
}
