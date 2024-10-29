<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\Factory\ColumnFactoryInterface;
use Jeandanyel\ListBundle\Mapper\RequestHandlerMapper;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ResolvedListTypeInterface
{
    public function getParent(): ?ResolvedListTypeInterface;

    public function getInnerType(): ListTypeInterface;

    public function buildList(ListBuilderInterface $builder, array $options): void;

    public function getOptionsResolver(): OptionsResolver;

    public function createBuilder(ColumnFactoryInterface $columnRegistry, RequestHandlerMapper $requestHandlerMapper, array $options = []): ListBuilderInterface;
}