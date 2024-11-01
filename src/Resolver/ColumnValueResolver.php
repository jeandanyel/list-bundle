<?php

namespace Jeandanyel\ListBundle\Resolver;

use Jeandanyel\ListBundle\Column\ColumnInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class ColumnValueResolver implements ColumnValueResolverInterface
{
    public function __construct(private PropertyAccessorInterface $propertyAccessor) {}

    public function resolve(object $object, ColumnInterface $column): mixed
    {
        return $this->propertyAccessor->getValue($object, $column->getName());
    }
}
