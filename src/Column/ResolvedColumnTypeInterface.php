<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Column\ColumnTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ResolvedColumnTypeInterface
{
    public function getParent(): ?ResolvedColumnTypeInterface;

    public function getInnerType(): ColumnTypeInterface;

    public function getOptionsResolver(): OptionsResolver;
}
