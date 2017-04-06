<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user")
     */
    private $tasks;
    
    public function __construct()
    {
        parent::__construct();
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function getTasks() {
        return $this->tasks;
    }

    function setTasks($tasks) {
        $this->tasks = $tasks;
    }


}