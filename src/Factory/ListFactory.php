<?php

namespace Jeandanyel\ListBundle\Factory;

use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\List\ListInterface;
use Jeandanyel\ListBundle\Mapper\RequestHandlerMapper;
use Jeandanyel\ListBundle\Registry\ListRegistryInterface;

class ListFactory implements ListFactoryInterface
{
    public function __construct(
        private ListRegistryInterface $listRegistry,
        private ColumnFactoryInterface $columnFactory,
        private RequestHandlerMapper $requestHandlerMapper,
    ) {}

    public function create(string $listTypeClass, array $options = []): ListInterface
    {
        return $this->createBuilder($listTypeClass, $options)->getList();
    }

    public function createBuilder(string $listTypeClass, array $options = []): ListBuilderInterface
    {
        $listType = $this->listRegistry->getType($listTypeClass);
        $builder = $listType->createBuilder($this->columnFactory, $this->requestHandlerMapper, $options);

        $listType->buildList($builder, $builder->getOptions());

        return $builder;
    }
}
