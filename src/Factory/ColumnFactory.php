<?php

namespace Jeandanyel\ListBundle\Factory;

use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Column\ColumnInterface;
use Jeandanyel\ListBundle\Registry\ColumnRegistryInterface;

class ColumnFactory implements ColumnFactoryInterface
{
    public function __construct(private ColumnRegistryInterface $columnRegistry) {}

    public function create(string $name, string $columnTypeClass, array $options = []): ColumnInterface
    {
        $columnType = $this->columnRegistry->getType($columnTypeClass);
        $optionsResolver = clone $columnType->getOptionsResolver();
        $resolvedOptions = $optionsResolver->resolve($options);
        $column = new Column();

        $column->setName($name);
        $column->setLabel($resolvedOptions['label']);
        $column->setSortable($resolvedOptions['sortable']);
        $column->setSearchable($resolvedOptions['searchable']);
        $column->setValueResolver($resolvedOptions['value_resolver']);

        return $column;
    }
}
