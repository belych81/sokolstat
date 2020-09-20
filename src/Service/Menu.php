<?php
namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Menu
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function generate($country, $season = '2020-21')
    {

      if ($country == 'russia' || $country == 'fnl') {
        $menu = [
          [
            'name' => 'Чемпионат',
            'url' => $this->router->generate('championships', ['country' => 'russia', 'season' => $season])
          ]
        ];
        $menu[1] = [
                'name' => 'Кубок',
                'url' => $this->router->generate('cup', ['season' => $season])
        ];
        $menu[2] = [
                'name' => 'Cуперкубок',
                'url' => $this->router->generate('supercup', ['country' => 'russia'])
        ];
        $menu[3] = [
                'name' => 'ФНЛ',
                'url' => $this->router->generate('championships', ['country' => 'fnl', 'season' => $season])
        ];
      } else {
        $menu = [
          [
            'name' => 'Чемпионат',
            'url' => $this->router->generate('championships', ['country' => $country, 'season' => $season])
          ]
        ];
        $menu[1] = [
                'name' => 'Кубок',
                'url' => $this->router->generate('nationcup', ['country' => $country, 'season' => $season])
        ];
        $menu[2] = [
                'name' => 'Cуперкубок',
                'url' => $this->router->generate('supercup', ['country' => $country])
        ];
      }

      ksort($menu);

      return $menu;
    }

    public function generateEurocup($season = '2019-20')
    {
      $menu = [
        [
          'name' => 'Лига Чемпионов',
          'url' => $this->router->generate('eurocup', ['turnir' => 'leagueChampions', 'season' => $season]),
          'route' => 'eurocup'
        ],
        [
          'name' => 'Лига Европы',
          'url' => $this->router->generate('eurocup', ['turnir' => 'leagueEuropa', 'season' => $season]),
          'route' => 'eurocup'
        ],
        [
          'name' => 'Суперкубок Европы',
          'url' => $this->router->generate('supercup', ['country' => 'uefa']),
          'route' => 'supercup'
        ],
        [
          'name' => 'Клубный чемпионат мира',
          'url' => $this->router->generate('eurocup', ['turnir' => 'worldCupClub', 'season' => '2019']),
          'route' => 'eurocup'
        ]
      ];

      return $menu;
    }

    public function generateMundial()
    {
      $menu = [
        [
          'name' => 'Чемпионаты Мира',
          'url' => $this->router->generate('sbornie', ['turnir' => 'worldcup', 'year' => '2018']),
          'route' => 'sbornie'
        ],
        [
          'name' => 'Чемпионаты Европы',
          'url' => $this->router->generate('sbornie', ['turnir' => 'euro', 'year' => '2016']),
          'route' => 'sbornie'
        ],
        [
          'name' => 'Кубок Конфедераций',
          'url' => $this->router->generate('sbornie', ['turnir' => 'confederationscup', 'year' => '2017']),
          'route' => 'sbornie'
        ],
        [
          'name' => 'Сборная России',
          'url' => $this->router->generate('sbornieRus', ['season' => '2019']),
          'route' => 'sbornieRus'
        ]
      ];

      return $menu;
    }

}
