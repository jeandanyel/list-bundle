<?php

namespace Jeandanyel\ListBundle\Resolver;

use Jeandanyel\ListBundle\Column\ColumnInterface;

interface ColumnValueResolverInterface
{
    public function resolve(object|array $object, ColumnInterface $column): mixed;
}
