<?php

namespace Jeandanyel\ListBundle\Provider;

use Jeandanyel\ListBundle\List\ListInterface;

interface DataProviderInterface
{
    public function getData(ListInterface $list): mixed;
}
