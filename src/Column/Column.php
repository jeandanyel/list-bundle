<?php

namespace Jeandanyel\ListBundle\Column;

class Column implements ColumnInterface
{
    private string $name;
    private string $label;
    private bool $sortable = false;
    private bool $searchable = false;
    private array $options = [];

    /**
     * @var callable
     */
    private $valueResolver;

    /**
     * @var null|callable
     */
    private $valueFormatter;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function setSortable(bool $sortable): self
    {
        $this->sortable = $sortable;

        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function setSearchable(bool $searchable): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function setValueResolver(callable $valueResolver): self
    {
        $this->valueResolver = $valueResolver;

        return $this;
    }

    public function getValueResolver(): callable
    {
        return $this->valueResolver;
    }

    public function setValueFormatter(?callable $valueFormatter): self
    {
        $this->valueFormatter = $valueFormatter;

        return $this;
    }

    public function getValueFormatter(): ?callable
    {
        return $this->valueFormatter;
    }

    public function getValue(mixed $object): mixed
    {
        $valueResolver = $this->getValueResolver();
        $valueFormatter = $this->getValueFormatter();
        $value = $valueResolver($object, $this);

        if ($valueFormatter) {
            $value = $valueFormatter($value, $this);
        }
            
        return $value;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
