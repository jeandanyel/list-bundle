<?php

namespace Jeandanyel\ListBundle\Registry;

use Jeandanyel\ListBundle\List\ListTypeInterface;
use Jeandanyel\ListBundle\List\ResolvedListType;
use Jeandanyel\ListBundle\List\ResolvedListTypeInterface;
use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

/**
 * @property RewindableGenerator<int, ListTypeInterface> $types
 */
class ListRegistry implements ListRegistryInterface
{
    /**
     * @var ResolvedListTypeInterface[]
     */
    private array $resolvedTypes = [];

    public function __construct(private RewindableGenerator $types) {}

    public function getType(string $typeClass): ResolvedListTypeInterface
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

    public function resolveType(ListTypeInterface $type): ResolvedListTypeInterface
    {
        $parent = null;
    
        if ($type->getParent()) {
            $parent = $this->getType($type->getParent());
        }
        
        return new ResolvedListType($type, $parent);
    }
}
