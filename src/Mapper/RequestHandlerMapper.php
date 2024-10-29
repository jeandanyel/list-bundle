<?php

namespace Jeandanyel\ListBundle\Mapper;

use Jeandanyel\ListBundle\Handler\GridJsRequestHandler;
use Jeandanyel\ListBundle\List\GridJsList;
use Jeandanyel\ListBundle\Handler\RequestHandlerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class RequestHandlerMapper implements ServiceSubscriberInterface
{
    public function __construct(private ContainerInterface $serviceLocator) {}

    public static function getSubscribedServices(): array
    {
        return [
            GridJsList::class => GridJsRequestHandler::class
        ];
    }

    public function get(string $listClass): ?RequestHandlerInterface
    {
        if ($this->serviceLocator->has($listClass)) {
            return $this->serviceLocator->get($listClass);
        }

        return null;
    }
}
