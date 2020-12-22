<?php
namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Props
{
    private $lastSeason = '2020-21';

    public function getLastSeason(): ?string
    {
      return $this->lastSeason;
    }
}
