<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\Provider\DataProvider;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListType extends AbstractListType
{
    public function __construct(private DataProvider $dataProvider) {}

    public function buildList(ListBuilderInterface $builder, array $options): void {}

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults([
            'list_class' => GridJsList::class,
            'entity_class' => null,
            'data_provider' => $this->dataProvider,
            'data' => null,
        ]);

        $optionsResolver->setAllowedTypes('data_provider', DataProviderInterface::class);
    }

    public function getParent(): ?string
    {
        return null;
    }
}
