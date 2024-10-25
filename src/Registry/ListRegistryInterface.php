<?php

namespace Jeandanyel\ListBundle\Registry;

use Jeandanyel\ListBundle\List\ListTypeInterface;
use Jeandanyel\ListBundle\List\ResolvedListTypeInterface;

interface ListRegistryInterface
{
    public function getType(string $typeClass): ResolvedListTypeInterface;

    public function resolveType(ListTypeInterface $type): ResolvedListTypeInterface;
}
