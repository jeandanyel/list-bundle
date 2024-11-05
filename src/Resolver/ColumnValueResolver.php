<?php

namespace Jeandanyel\ListBundle\Resolver;

use Jeandanyel\ListBundle\Column\ColumnInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class ColumnValueResolver implements ColumnValueResolverInterface
{
    public function __construct(private PropertyAccessorInterface $propertyAccessor) {}

    public function resolve(object|array $object, ColumnInterface $column): mixed
    {
        $properties = explode('.', $column->getName());
        $value = $object;

        foreach ($properties as $property) {
            if (is_array($value)) {
                $property = "[$property]";
            }

            $value = $this->propertyAccessor->getValue($value, $property);

            if ($value === null) {
                break;
            }
        }

        return $value;
    }
}
