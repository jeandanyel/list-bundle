<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Builder\ColumnBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ColumnTypeInterface
{
    public function buildColumn(ColumnBuilderInterface $builder, array $options): void;
    public function configureOptions(OptionsResolver $optionsResolver): void;
    public function getParent(): ?string;
}
