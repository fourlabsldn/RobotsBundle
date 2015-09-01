<?php

namespace FourLabs\RobotsBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ConfigurationListener implements EventSubscriberInterface
{
    private $blockAll;

    public function __construct($blockAll)
    {
        $this->blockAll = $blockAll;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if(!$this->blockAll) {
            return;
        }

        $event->getResponse()->headers->set('X-Robots-Tag', 'none');
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
