<?php

namespace Jeandanyel\ListBundle\Resolver;

use Jeandanyel\ListBundle\Column\Column;

interface ColumnValueResolverInterface
{
    public function resolve(object $object, Column $column): mixed;
}
