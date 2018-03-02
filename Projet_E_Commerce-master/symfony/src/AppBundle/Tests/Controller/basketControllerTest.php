<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class basketControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pannier');
    }

    public function testAddbasket()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addBasket');
    }

    public function testClearbasket()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/clearBasket');
    }

}
