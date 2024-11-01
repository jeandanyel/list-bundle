<?php

namespace Jeandanyel\ListBundle\Formatter;

use Jeandanyel\ListBundle\Column\ColumnInterface;

interface FormatterInterface 
{
    public function format(mixed $value, ColumnInterface $column): mixed;
}