<?php

namespace App\EventSubscriber;

use App\Service\AuthService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AppStartupSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        // Only run once, on the main request (not sub-requests)
        if (!$event->isMainRequest()) {
            return;
        }

        // Initialize test user if necessary
        AuthService::initializeTestUser();
    }
}