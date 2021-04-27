<?php
namespace App\Service;

class Admin
{
    private $params = [
      'limit' => 30,
      'entities' => [
        'Rfplmatch' => ['id', 'season', 'data', 'tour', 'team', 'team2', 'goal1', 'goal2', 'bomb'],
        'Tour' => ['id', 'season', 'data', 'tour', 'team', 'team2', 'goal1', 'goal2', 'bomb'],
        'NationCup' => ['id', 'season', 'data', 'team', 'team2', 'stadia', 'score', 'bomb'],
        'Cup' => ['id', 'season', 'data', 'team', 'team2', 'stadia', 'score', 'bomb'],
        'Eurocup' => ['id', 'turnir', 'season', 'data', 'team', 'team2', 'stadia', 'score', 'bomb'],
      ]
    ];

    public function getParams(): array
    {
        return $this->params;
    }

}
