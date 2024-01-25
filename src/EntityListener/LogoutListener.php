<?php

namespace App\EntityListener;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutListener
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $event)
    {
        $this->session->getFlashBag()->add('error', 'Vous avez été déconnecté.');
    }
}

?>