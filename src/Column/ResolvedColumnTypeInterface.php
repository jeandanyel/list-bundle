<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Builder\ColumnBuilderInterface;
use Jeandanyel\ListBundle\Column\ColumnTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ResolvedColumnTypeInterface
{
    public function getParent(): ?ResolvedColumnTypeInterface;

    public function getInnerType(): ColumnTypeInterface;

    public function buildColumn(ColumnBuilderInterface $builder, array $options): void;

    public function getOptionsResolver(): OptionsResolver;

    public function createBuilder(string $name, array $options = []): ColumnBuilderInterface;
}
