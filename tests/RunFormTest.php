<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RunFormTest extends WebTestCase
{
    public function testCreate()
    {
        // TODO : mettre les credentials dans env
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'stadline@stadline.com',
            'PHP_AUTH_PW'   => 'stadline',
        ]);

        $crawler = $client->request('GET', '/dashboard/run/create');
        $form = $crawler->selectButton('Submit')->form();
        $client->submit($form, [
            'run[datetime][date][month]' => '12',
            'run[datetime][date][day]' => '11',
            'run[datetime][date][year]' => '2020',
            'run[datetime][time][hour]' => '10',
            'run[datetime][time][minute]' => '58',
            'run[distance]' => 5000,
            'run[duration]' => 2000,
            'run[comment]' => 'Awesome comment',
        ]);
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
