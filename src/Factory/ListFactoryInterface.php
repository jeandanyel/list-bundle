<?php

namespace Jeandanyel\ListBundle\Factory;

use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\List\ListInterface;

interface ListFactoryInterface
{
    public function create(string $listTypeClass, array $options = []): ListInterface;

    public function createBuilder(string $listTypeClass, array $options = []): ListBuilderInterface;
}
