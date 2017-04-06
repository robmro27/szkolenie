<?php

namespace tests\AppBundle\Controller;

use AppBundle\DataFixtures\ORM\LoadUserData;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    public function testAddTest()
    {
        $fixtures = $this->loadFixtures([
            LoadUserData::class])->getReferenceRepository();

        $client = $this->makeClient(['username' => 'admin', 'password' => 'admin']);
        $crawler = $client->request('GET', '/task/');

        $form = $crawler->filter('form[name=task]')
            ->form(['task' => [ 'name' => 'blab' ]]);

        $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/task/');

        $this->assertEquals(1, $crawler->filter('#table > tbody > tr')->count());

    }

}
