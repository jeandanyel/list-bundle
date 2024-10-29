<?php

namespace Jeandanyel\ListBundle;

use Jeandanyel\ListBundle\Column\ColumnTypeInterface;
use Jeandanyel\ListBundle\Handler\RequestHandlerInterface;
use Jeandanyel\ListBundle\List\ListTypeInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class JeandanyelListBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');

        $builder->registerForAutoconfiguration(ListTypeInterface::class)
            ->addTag('list.list_type')
        ;

        $builder->registerForAutoconfiguration(ColumnTypeInterface::class)
            ->addTag('list.column_type')
        ;

        $builder->registerForAutoconfiguration(RequestHandlerInterface::class)
            ->addTag('list.request_handler')
        ;
    }
}
