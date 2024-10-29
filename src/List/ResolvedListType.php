<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Builder\ListBuilder;
use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\Factory\ColumnFactoryInterface;
use Jeandanyel\ListBundle\Mapper\RequestHandlerMapper;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResolvedListType implements ResolvedListTypeInterface
{
    private OptionsResolver $optionsResolver;

    public function __construct(
        private ListTypeInterface $innerType,
        private ?ResolvedListTypeInterface $parent = null
    ) {}

    public function getParent(): ?ResolvedListTypeInterface
    {
        return $this->parent;
    }

    public function getInnerType(): ListTypeInterface
    {
        return $this->innerType;
    }

    public function buildList(ListBuilderInterface $builder, array $options): void
    {
        if ($this->parent !== null) {
            $this->parent->buildList($builder, $options);
        }

        $this->innerType->buildList($builder, $options);
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

    public function createBuilder(ColumnFactoryInterface $columnFactory, RequestHandlerMapper $requestHandlerMapper, array $options = []): ListBuilderInterface
    {
        try {
            $options = $this->getOptionsResolver()->resolve($options);
        } catch (\Throwable $e) {
            throw new $e(sprintf('An error has occurred resolving the options of the list "%s": ', get_debug_type($this->getInnerType())).$e->getMessage(), $e->getCode(), $e);
        }

        $builder = new ListBuilder($columnFactory, $requestHandlerMapper, $options);

        $builder->setType($this);

        return $builder;
    }
}
