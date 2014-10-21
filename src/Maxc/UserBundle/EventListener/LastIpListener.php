<?php
namespace Maxc\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class LastIpListener implements EventSubscriberInterface
{
    protected $userManager;
    private $container;

    public function __construct($container, UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
    }

    public function onImplicitLogin(UserEvent $event)
    {
        $user = $event->getUser();

        $user->setIp($this->container->get('request')->getClientIp());
        $this->userManager->updateUser($user);
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if ($user instanceof UserInterface) {
            $user->setIp($this->container->get('request')->getClientIp());
            $this->userManager->updateUser($user);
        }
    }

}
