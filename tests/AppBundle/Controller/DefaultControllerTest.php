<?php

namespace tests\AppBundle\Controller;

use AppBundle\DataFixtures\ORM\LoadUserData;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexNotLogged()
    {
        $fixtures= $this->loadFixtures([
                LoadUserData::class])->getReferenceRepository();
        
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/');
        
        $this->assertStatusCode(302, $client);
    }
}
