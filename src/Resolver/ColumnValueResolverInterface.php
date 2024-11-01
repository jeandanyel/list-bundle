<?php

namespace Jeandanyel\ListBundle\Resolver;

use Jeandanyel\ListBundle\Column\ColumnInterface;

interface ColumnValueResolverInterface
{
    public function resolve(object $object, ColumnInterface $column): mixed;
}
