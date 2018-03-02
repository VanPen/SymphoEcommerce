<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrdersControllerTest extends WebTestCase
{
    public function testManageorder()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/manage_order/{id}');
    }

}
