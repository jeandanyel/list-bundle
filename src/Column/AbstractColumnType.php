<?php

namespace Jeandanyel\ListBundle\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractColumnType implements ColumnTypeInterface
{
    public function configureOptions(OptionsResolver $resolver): void
    {
    }

    public function getParent(): ?string
    {
        return ColumnType::class;
    }
}
