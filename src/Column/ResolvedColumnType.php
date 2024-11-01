<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Builder\ColumnBuilder;
use Jeandanyel\ListBundle\Builder\ColumnBuilderInterface;
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

    public function buildColumn(ColumnBuilderInterface $builder, array $options): void
    {
        if ($this->parent !== null) {
            $this->parent->buildColumn($builder, $options);
        }

        $this->innerType->buildColumn($builder, $options);
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

    public function createBuilder(string $name, array $options = []): ColumnBuilderInterface
    {
        try {
            $options = $this->getOptionsResolver()->resolve($options);
        } catch (\Throwable $e) {
            throw new $e(sprintf('An error has occurred resolving the options of the column "%s": ', get_debug_type($this->getInnerType())).$e->getMessage(), $e->getCode(), $e);
        }

        $builder = new ColumnBuilder($name, $options);

        $builder->setType($this);

        return $builder;
    }
}
