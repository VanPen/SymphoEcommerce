<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testAdd_user()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add_user');
    }

}
