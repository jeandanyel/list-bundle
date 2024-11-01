<?php

namespace Jeandanyel\ListBundle\Formatter;

use DateTime;
use Jeandanyel\ListBundle\Column\ColumnInterface;

class DateFormatter implements FormatterInterface
{
    public function format(mixed $value, ColumnInterface $column): mixed
    {
        $options = $column->getOptions();

        if (!$value instanceof \DateTimeInterface) {
            $value = new DateTime((string) $value);
        }

        return $value->format($options['format']);
    }
}