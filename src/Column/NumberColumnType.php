<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Formatter\NumberFormatter;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NumberColumnType extends AbstractColumnType
{
    public function __construct(private NumberFormatter $numberFormatter) {}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'decimals' => 2,
            'decimal_separator' => '.', 
            'thousands_separator' => ',',
            'rounding_mode' => \NumberFormatter::ROUND_HALFUP,
            'trim_trailing_zeros' => false,
            'value_formatter' => [$this->numberFormatter, 'format'],
        ]);

        $resolver->setAllowedTypes('decimals', 'int');
        $resolver->setAllowedTypes('decimal_separator', 'string');
        $resolver->setAllowedTypes('thousands_separator', 'string');
        $resolver->setAllowedTypes('trim_trailing_zeros', 'bool');

        $resolver->setAllowedValues('rounding_mode', [
            \NumberFormatter::ROUND_FLOOR,
            \NumberFormatter::ROUND_DOWN,
            \NumberFormatter::ROUND_HALFDOWN,
            \NumberFormatter::ROUND_HALFEVEN,
            \NumberFormatter::ROUND_HALFUP,
            \NumberFormatter::ROUND_UP,
            \NumberFormatter::ROUND_CEILING,
        ]);
    }
}
