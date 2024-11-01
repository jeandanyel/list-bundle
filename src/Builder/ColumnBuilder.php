<?php

namespace Jeandanyel\ListBundle\Builder;

use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Column\ColumnInterface;
use Jeandanyel\ListBundle\Column\ResolvedColumnTypeInterface;

class ColumnBuilder implements ColumnBuilderInterface
{
    private ResolvedColumnTypeInterface $type;

    public function __construct(
        private string $name,
        private array $options = [],
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ResolvedColumnTypeInterface
    {
        return $this->type;
    }

    public function setType(ResolvedColumnTypeInterface $type): self
    {
        $this->type = $type;
    
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getColumn(): ColumnInterface
    {
        $column = new Column();

        $column->setName($this->name);
        $column->setLabel($this->options['label'] ?? $this->name);
        $column->setSortable($this->options['sortable']);
        $column->setSearchable($this->options['searchable']);
        $column->setValueResolver($this->options['value_resolver']);
        $column->setValueFormatter($this->options['value_formatter']);
        $column->setOptions($this->options);

        return $column;
    }
}
