<?php

namespace Maxc\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals('Maxc\SiteBundle\Controller\DefaultController::indexAction', $client->getRequest()->attributes->get('_controller'));
    }

    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        $this->assertTrue($crawler->filter('h1:contains("About")')->count() > 0);
    }
}
