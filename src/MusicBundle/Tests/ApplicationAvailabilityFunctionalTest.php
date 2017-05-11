<?php

namespace MusicBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Smoke test !
 * Voir ici : http://symfony.com/doc/2.8/best_practices/tests.html#functional-tests
 */

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/'),
            array('/artiste/creation'),
            array('/artiste/radiohead/modification'),
            array('/artiste/radiohead/album'),
            array('/artiste/radiohead/album/creation'),
            array('/artiste/radiohead/album/4/modification'),
            array('/artiste/radiohead/album/4/chansons'),
            array('/artiste/radiohead/album/4/chansons/creation')
        );
    }
}