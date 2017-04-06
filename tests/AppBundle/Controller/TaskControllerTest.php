<?php

namespace tests\AppBundle\Controller;

use AppBundle\DataFixtures\ORM\LoadUserData;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase {
   
    public function teskAddTast()
    {
        $fixtures= $this->loadFixtures([
                LoadUserData::class])->getReferenceRepository();
        
        $client = $this->makeClient(['username' => 'admin', 'password' => 'admin']);
        $crawler = $client->request('GET', '/');
        
        $user = $fixtures->getReferences('user');
    }
    
}
