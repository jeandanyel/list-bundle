<?php

namespace Jeandanyel\ListBundle\Factory;

use Jeandanyel\ListBundle\Builder\ColumnBuilderInterface;
use Jeandanyel\ListBundle\Column\ColumnInterface;
use Jeandanyel\ListBundle\Registry\ColumnRegistryInterface;

class ColumnFactory implements ColumnFactoryInterface
{
    public function __construct(private ColumnRegistryInterface $columnRegistry) {}

    public function create(string $name, string $columnTypeClass, array $options = []): ColumnInterface
    {
        return $this->createBuilder($name, $columnTypeClass, $options)->getColumn();
    }

    public function createBuilder(string $name, string $columnTypeClass, array $options = []): ColumnBuilderInterface
    {
        $columnType = $this->columnRegistry->getType($columnTypeClass);
        $builder = $columnType->createBuilder($name, $options);

        $columnType->buildColumn($builder, $builder->getOptions());

        return $builder;
    }
}
