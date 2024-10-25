<?php

namespace Jeandanyel\ListBundle\Registry;

use Jeandanyel\ListBundle\Column\ResolvedColumnTypeInterface;

interface ColumnRegistryInterface
{
    public function getType(string $columnTypeClass): ResolvedColumnTypeInterface;
}
