<?php
namespace App\Service;

class Admin
{
    private $params = [
      'limit' => 30,
      'entities' => [
        'Rfplmatch' => ['fields' => ['id', 'season', 'data', 'tour', 'team', 'team2', 'goal1', 'goal2', 'bomb']],
        'Tour' => ['fields' => ['id', 'season', 'data', 'tour', 'team', 'team2', 'goal1', 'goal2', 'bomb']],
        'NationCup' => ['fields' => ['id', 'season', 'data', 'team', 'team2', 'stadia', 'score', 'bomb']],
        'Cup' => ['fields' => ['id', 'season', 'data', 'team', 'team2', 'stadia', 'score', 'bomb']],
        'Eurocup' => ['fields' => ['id', 'turnir', 'season', 'data', 'team', 'team2', 'stadia', 'score', 'bomb']],
        'Gamers' => [
          'fields' => ['id', 'player', 'country', 'team', 'season', 'game', 'goal', 'born'],
          'filter' => ['season', 'team', 'country']
        ],
        'Shipplayer' => [
          'fields' => ['id', 'player', 'country', 'team', 'season', 'game', 'goal', 'born'],
          'filter' => ['season', 'team', 'country']
          ]
      ]
    ];

    public function getParams(): array
    {
        return $this->params;
    }

}
