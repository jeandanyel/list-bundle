<?php

namespace Jeandanyel\ListBundle\Builder;

use Jeandanyel\ListBundle\List\ListInterface;
use Jeandanyel\ListBundle\List\ResolvedListTypeInterface;

interface ListBuilderInterface
{
    public function setType(ResolvedListTypeInterface $type): self;

    public function getType(): ResolvedListTypeInterface;

    public function getOptions(): array;

    public function add(string $name, string $columnTypeClass, array $options = []): self;

    public function getList(): ListInterface;
}
