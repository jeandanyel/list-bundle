<?php

namespace Jeandanyel\ListBundle\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ColumnType extends AbstractColumnType
{
    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults([
            'label' => null,
            'sortable' => false,
            'searchable' => false,
        ]);

        $optionsResolver->setAllowedTypes('label', ['null', 'string']);
        $optionsResolver->setAllowedTypes('sortable', 'bool');
        $optionsResolver->setAllowedTypes('searchable', 'bool');
    }

    public function getParent(): ?string
    {
        return null;
    }
}