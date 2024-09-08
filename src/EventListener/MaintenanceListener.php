<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class MaintenanceListener
{
    #[AsEventListener(event: KernelEvents::REQUEST, priority: 2000)]
    public function onKernelRequest(RequestEvent $event): void
    {
        // ...
    }
}
