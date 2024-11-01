<?php

namespace Jeandanyel\ListBundle\Builder;

use Jeandanyel\ListBundle\Column\ColumnInterface;
use Jeandanyel\ListBundle\Column\ResolvedColumnTypeInterface;

interface ColumnBuilderInterface
{
    public function getName(): string;

    public function setName(string $name): self;
    
    public function getType(): ResolvedColumnTypeInterface;

    public function setType(ResolvedColumnTypeInterface $type): self;

    public function getOptions(): array;

    public function getColumn(): ColumnInterface;
}
