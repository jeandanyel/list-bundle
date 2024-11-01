<?php

namespace Jeandanyel\ListBundle\Resolver;

use Jeandanyel\ListBundle\Column\ColumnInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class ColumnValueResolver implements ColumnValueResolverInterface
{
    public function __construct(private PropertyAccessorInterface $propertyAccessor) {}

    public function resolve(object|array $object, ColumnInterface $column): mixed
    {
        $columnName = $column->getName();

        if (is_array($object)) {
            $columnName = "[$columnName]";
        }

        return $this->propertyAccessor->getValue($object, $columnName);
    }
}
