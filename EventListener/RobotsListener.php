<?php

namespace FourLabs\RobotsBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use FourLabs\RobotsBundle\Configuration\Robots;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;

class RobotsListener implements EventSubscriberInterface
{
    private $annotationReader;

    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if(!is_array($controller)) {
            return;
        }

        $action = new \ReflectionMethod($controller[0], $controller[1]);

        $robotsAnnotation = $this->annotationReader->getMethodAnnotation(
            $action,
            'FourLabs\RobotsBundle\Configuration\Robots'
        );

        if(!($robotsAnnotation instanceof Robots)) {
            return;
        }

        $event->getRequest()->attributes->set('_robots', $robotsAnnotation->getHttpHeader());
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $robots = $event->getRequest()->attributes->get('_robots');

        if(is_null($robots)) {
            return;
        }

        $event->getResponse()->headers->set('X-Robots-Tag', $robots);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
