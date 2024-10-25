<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Column\ColumnTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResolvedColumnType implements ResolvedColumnTypeInterface
{
    private OptionsResolver $optionsResolver;

    public function __construct(
        private ColumnTypeInterface $innerType,
        private ?ResolvedColumnTypeInterface $parent = null
    ) {}

    public function getParent(): ?ResolvedColumnTypeInterface
    {
        return $this->parent;
    }

    public function getInnerType(): ColumnTypeInterface
    {
        return $this->innerType;
    }

    public function getOptionsResolver(): OptionsResolver
    {
        if (!isset($this->optionsResolver)) {
            if ($this->parent !== null) {
                $this->optionsResolver = clone $this->parent->getOptionsResolver();
            } else {
                $this->optionsResolver = new OptionsResolver();
            }

            $this->innerType->configureOptions($this->optionsResolver);
        }

        return $this->optionsResolver;
    }
}
