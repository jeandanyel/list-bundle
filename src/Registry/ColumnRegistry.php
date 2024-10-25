<?php

namespace Jeandanyel\ListBundle\Registry;

use Jeandanyel\ListBundle\Column\ColumnTypeInterface;
use Jeandanyel\ListBundle\Column\ResolvedColumnType;
use Jeandanyel\ListBundle\Column\ResolvedColumnTypeInterface;
use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

/**
 * @property RewindableGenerator<int, ColumnTypeInterface> $types
 */
class ColumnRegistry implements ColumnRegistryInterface
{
    /**
     * @var ResolvedColumnTypeInterface[]
     */
    private array $resolvedTypes = [];

    public function __construct(private RewindableGenerator $types) {}

    public function getType(string $typeClass): ResolvedColumnTypeInterface
    {
        if (!isset($resolvedTypes[$typeClass])) {
            foreach ($this->types as $type) {
                if ($type instanceof $typeClass) {
                    $this->resolvedTypes[$typeClass] = $this->resolveType($type);

                    break;
                }
            }
        }

        return $this->resolvedTypes[$typeClass];
    }

    public function resolveType(ColumnTypeInterface $type): ResolvedColumnTypeInterface
    {
        $parent = null;
    
        if ($type->getParent()) {
            $parent = $this->getType($type->getParent());
        }
        
        return new ResolvedColumnType($type, $parent);
    }
}
