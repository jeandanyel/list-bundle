<?php

namespace Jeandanyel\ListBundle\Formatter;

use Jeandanyel\ListBundle\Column\ColumnInterface;

class NumberFormatter implements FormatterInterface
{
    public function format(mixed $value, ColumnInterface $column): mixed
    {
        $options = $column->getOptions();
        $decimals = $options['decimals'];
        $decimalSeparator = $options['decimal_separator'];
        $thousandsSeparator = $options['thousands_separator'];
        $roundingMode = $options['rounding_mode'];

        if ($roundingMode !== null) {
            $value = round($value, $decimals, $roundingMode);
        }

        $value = number_format($value, $decimals, $decimalSeparator, $thousandsSeparator);

        if ($options['trim_trailing_zeros']) {
            $value = rtrim($value, '0');
            $value = rtrim($value, $decimalSeparator);
        }

        return $value;
    }
}