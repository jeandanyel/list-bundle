<?php

namespace Jeandanyel\ListBundle\Builder;

use Jeandanyel\ListBundle\Factory\ColumnFactoryInterface;
use Jeandanyel\ListBundle\List\GridJsList;
use Jeandanyel\ListBundle\List\ListInterface;
use Jeandanyel\ListBundle\List\ResolvedListTypeInterface;

class ListBuilder implements ListBuilderInterface
{
    private ResolvedListTypeInterface $type;
    private $unresolvedColumns = [];

    public function __construct(
        private ColumnFactoryInterface $columnFactory,
        private array $options = []
    ) {}

    public function setType(ResolvedListTypeInterface $type): self
    {
        $this->type = $type;
    
        return $this;
    }

    public function getType(): ResolvedListTypeInterface
    {
        return $this->type;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function add(string $name, string $columnTypeClass, array $options = []): self
    {
        $this->unresolvedColumns[$name] = [$columnTypeClass, $options];

        return $this;
    }

    public function getList(): ListInterface
    {
        $list = new GridJsList();

        $list->setEntityClass($this->options['entity_class']);
        $list->setDataProvider($this->options['data_provider']);
        $list->setQueryBuilder($this->options['query_builder']);

        foreach ($this->unresolvedColumns as $name => [$columnTypeClass, $options]) {
            $column = $this->columnFactory->create($name, $columnTypeClass, $options);
            
            $list->addColumn($column);
        }

        return $list;
    }
}
