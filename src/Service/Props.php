<?php
namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class Props
{
    private $lastSeason = '2024-25';
    private $lastMundSeason = 2024;
    private $sbornieRusYear = 2023;
    private $topEmblem = [
      'Англия' => 'Premier_League.svg.png',
      'Испания' => 'LaLiga.svg.png',
      'Италия' => 'Serie_A.png',
      'Германия' => 'Bundesliga.svg.png',
      'Франция' => 'Ligue_1.svg.png'
    ];

    private array $yaml = [];


    public function __construct()
    {
        if(empty($this->yaml)){
          $this->yaml = Yaml::parseFile(__DIR__.'/../../config/params.yaml');
        }
    }

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
        return $this->yaml['top']['country'];
    }

    public function getNoTops(): array
    {
        return $this->yaml['noTop']['country'];
    }

    public function getTranslateCountry(): array
    {
        return $this->yaml['translate'];
    }

    public function getNoTopsTeams(string $country): array
    {
        return $this->yaml['noTop']['teams'][$country];
    }

    public function getParams(): array
    {
        return $this->yaml;
    }

    public function getChamps32(): array
    {
        return $this->yaml['nfl']['champs_32'];
    }

    public function getChamps28(): array
    {
        return $this->yaml['nfl']['champs_28'];
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
