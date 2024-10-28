<?php

namespace Jeandanyel\ListBundle\Column;

use Jeandanyel\ListBundle\Resolver\ColumnValueResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColumnType extends AbstractColumnType
{
    public function __construct(private ColumnValueResolverInterface $columnValueResolver)
    {     
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults([
            'label' => null,
            'sortable' => true,
            'searchable' => false,
            'value_resolver' => [$this->columnValueResolver, 'resolve'],
        ]);

        $optionsResolver->setAllowedTypes('label', ['null', 'string']);
        $optionsResolver->setAllowedTypes('sortable', 'bool');
        $optionsResolver->setAllowedTypes('searchable', 'bool');
        $optionsResolver->setAllowedTypes('value_resolver', 'callable');
    }

    public function getParent(): ?string
    {
        return null;
    }
}