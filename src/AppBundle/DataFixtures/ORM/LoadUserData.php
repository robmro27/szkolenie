<?php
/**
 * Created by PhpStorm.
 * User: qweluke
 * Date: 4/6/17
 * Time: 1:31 PM
 */

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {
        $um = $this->container->get('fos_user.user_manager');

        $user = $um->createUser();

        $user->setUsername('admin');
        $user->setEmail('admin@localhost.net');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_USER']);

        $this->setReference('user', $user);

        $um->updateUser($user, true);

    }

    public function getOrder()
    {
        return 1;
    }
}