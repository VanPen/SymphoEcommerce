<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminUsersControllerTest extends WebTestCase
{
    public function testListusers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/users-list');
    }

}
