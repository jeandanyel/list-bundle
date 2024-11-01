<?php

namespace Jeandanyel\ListBundle\Factory;

use Jeandanyel\ListBundle\Builder\ColumnBuilderInterface;
use Jeandanyel\ListBundle\Column\ColumnInterface;

interface ColumnFactoryInterface
{
    public function create(string $name, string $columnTypeClass, array $options = []): ColumnInterface;

    public function createBuilder(string $name, string $columnTypeClass, array $options = []): ColumnBuilderInterface;
}
