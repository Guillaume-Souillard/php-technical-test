<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    public function testApiAllRuns()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/runs/all');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
