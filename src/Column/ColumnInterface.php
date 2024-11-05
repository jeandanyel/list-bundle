<?php

namespace Jeandanyel\ListBundle\Column;

interface ColumnInterface
{
    public function getName(): string;

    public function setName(string $name): self;

    public function getLabel(): string;

    public function setLabel(string $label): self;

    public function isSortable(): bool;

    public function setSortable(bool $sortable): self;

    public function isSearchable(): bool;

    public function setSearchable(bool $searchable): self;

    public function getOrder(): ?string;

    public function setOrder(?string $order): self;

    public function setValueResolver(callable $valueResolver): self;

    public function getValueResolver(): callable;

    public function setValueFormatter(?callable $valueFormatter): self;

    public function getValueFormatter(): ?callable;

    public function getValue(mixed $object): mixed;

    public function getOptions(): array;

    public function setOptions(array $options): self;
}
