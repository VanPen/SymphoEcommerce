<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class cardControllerTest extends WebTestCase
{
    public function testNewcard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newCard');
    }

    public function testEditcard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editCard');
    }

    public function testDeletecard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteCard');
    }

}
