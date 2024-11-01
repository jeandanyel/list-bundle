<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Formatter\DateFormatter;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateColumnType extends AbstractColumnType
{
    public function __construct(private DateFormatter $dateFormatter) {}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'format' => 'Y-m-d H:i:s',
            'value_formatter' => [$this->dateFormatter, 'format'],
        ]);

        $resolver->setAllowedTypes('format', 'string');
    }
}
