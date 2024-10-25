<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractListType implements ListTypeInterface
{
    abstract public function buildList(ListBuilderInterface $builder, array $options): void;

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
    }

    public function getParent(): ?string
    {
        return ListType::class;
    }
}
