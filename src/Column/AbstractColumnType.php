<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Builder\ColumnBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractColumnType implements ColumnTypeInterface
{
    public function buildColumn(ColumnBuilderInterface $builder, array $options): void {}

    public function configureOptions(OptionsResolver $resolver): void
    {
    }

    public function getParent(): ?string
    {
        return ColumnType::class;
    }
}
