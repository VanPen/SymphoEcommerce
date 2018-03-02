<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdressControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/adress/new');
    }

    public function testModif()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/adress/update');
    }

}
