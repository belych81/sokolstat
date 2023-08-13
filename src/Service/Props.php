<?php
namespace App\Service;

class Props
{
    private $lastSeason = '2023-24';
    private $lastMundSeason = 2024;
    private $sbornieRusYear = 2023;
    private $tops = ['Англия', 'Испания', 'Италия', 'Германия', 'Франция'];
    private $topEmblem = [
      'Англия' => 'Premier_League.svg.png',
      'Испания' => 'LaLiga.svg.png',
      'Италия' => 'Serie_A.png',
      'Германия' => 'Bundesliga.svg.png',
      'Франция' => 'Ligue_1.svg.png'
    ];

    public function getLastSeason(): ?string
    {
      return $this->lastSeason;
    }

    public function getLastMundSeason(): ?string
    {
      return $this->lastMundSeason;
    }

    public function getTops(): array
    {
        return $this->tops;
    }

    public function getTopEmblem(): array
    {
        return $this->topEmblem;
    }

    public function getSbornieRusYear(): int
    {
        return $this->sbornieRusYear;
    }

    public function getMonth(string $m): string
    {
      $months = [
        '01' => 'января',
        '02' => 'февраля',
        '03' => 'марта',
        '04' => 'апреля',
        '05' => 'мая',
        '06' => 'июня',
        '07' => 'июля',
        '08' => 'августа',
        '09' => 'сентября',
        '10' => 'октября',
        '11' => 'ноября',
        '12' => 'декабря'
      ];

      return $months[$m] ?? '';
    }
}
