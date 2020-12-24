<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testNewsPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(10, $crawler->filter('.title-news'));

        $client->clickLink('читать дальше');

        $this->assertCount(1, $crawler->filter('.title-news'));
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('div:contains("Назад к статьям")');
    }
}