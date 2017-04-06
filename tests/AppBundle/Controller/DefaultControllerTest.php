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
    
    public function testIndex()
    {
        $fixtures= $this->loadFixtures([
                LoadUserData::class])->getReferenceRepository();
        
        $client = $this->makeClient(['username' => 'admin', 'password' => 'admin']);
        $crawler = $client->request('GET', '/');
        
        $user = $fixtures->getReferences('user');
        $this->assertStatusCode(200, $client);
        
    }
    
    
}
