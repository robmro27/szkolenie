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
        $user = $fixtures->getReferences('user');
        
        $client->request('POST', '/', array('name' => 'Task 999', 'user' => $user));
        
        $user = $fixtures->getReferences('user');
        
        
        
    }
    
}
