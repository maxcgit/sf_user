<?php

namespace Maxc\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Maxc\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
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

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $em
     */
    public function load(ObjectManager $em)
    {

        $user = new User();
        $user->setUsername('admin');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);

        $encodedPassword = $encoder->encodePassword('123', $user->getSalt());
        $user->setPassword($encodedPassword);
        $user->setEmail('maxcim@gmail.com');
        $user->setEnabled(true);
        $user->addRole('ROLE_SUPER_ADMIN');

        $em->persist($user);

        for ($i=0; $i < 15; $i++) {
            $user = new User();
            $user->setUsername('user'.$i);
            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user);

            $encodedPassword = $encoder->encodePassword('123', $user->getSalt());
            $user->setPassword($encodedPassword);
            $user->setEmail($user->getUsername().'@gmail.com');
            $user->setEnabled(true);

            $em->persist($user);
        }
        $em->flush();
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}