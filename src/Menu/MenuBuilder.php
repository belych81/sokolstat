<?php

namespace App\Menu;

use App\Service\Props;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private $factory;
    private $params;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory, Props $props)
    {
        $this->factory = $factory;
        $this->params = $props->getParams();
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menuItems = $this->params['menu'];
        $arCountry = array_merge($this->params['top']['country'], $this->params['noTop']['country']);

        foreach($menuItems as $route => $item){
            if(!key_exists('params', $item)){
                $item['params'] = [];
            }
            foreach($item['params'] as &$value){
                if(key_exists($value, $this->params)){
                    $value = $this->params[$value];
                }
            }
            $menu->addChild($item['name'], [
                'route' => $route,
                'routeParameters' => $item['params']
            ]);
            if(key_exists('child', $item)){
                if($item['child'] == 'country'){
                    foreach($arCountry as $code => $name){
                        $menu[$item['name']]->addChild($name, [
                            'route' => $route,
                            'routeParameters' => ['country' => $code, 'season' => $this->params['season']]
                        ]);
                    }
                } else {
                    foreach($item['child'] as $child){
                        foreach($child['params'] as &$value){
                            if(key_exists($value, $this->params)){
                                $value = $this->params[$value];
                            }
                        }
                        $menu[$item['name']]->addChild($child['name'], [
                            'route' => $child['route'],
                            'routeParameters' => $child['params']
                        ]);
                    }
                }
            }
        }

        return $menu;
    }
}