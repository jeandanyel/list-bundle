<?php

namespace Jeandanyel\ListBundle\Factory;

use Jeandanyel\ListBundle\Column\ColumnInterface;

interface ColumnFactoryInterface
{
    public function create(string $name, string $columnTypeClass, array $options = []): ColumnInterface;
}
