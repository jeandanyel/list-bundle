<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Builder\ListBuilderInterface;
use Jeandanyel\ListBundle\Handler\RequestHandlerInterface;
use Jeandanyel\ListBundle\Provider\EntityDataProvider;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListType extends AbstractListType
{
    public function __construct(private EntityDataProvider $dataProvider) {}

    public function buildList(ListBuilderInterface $builder, array $options): void {}

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults([
            'list_class' => GridJsList::class,
            'entity_class' => null,
            'data' => null,
            'data_provider' => $this->dataProvider,
            'query_builder' => null,
            'fetch_data_from_request' => false,
            'request_handler' => null,
            'pagination' => true,
            'pagination_page' => 1,
            'pagination_limit' => 20,
        ]);

        $optionsResolver->setAllowedTypes('data', ['null', 'array']);
        $optionsResolver->setAllowedTypes('data_provider', DataProviderInterface::class);
        $optionsResolver->setAllowedTypes('query_builder', ['null', 'callable']);
        $optionsResolver->setAllowedTypes('fetch_data_from_request', 'bool');
        $optionsResolver->setAllowedTypes('request_handler', ['null', RequestHandlerInterface::class]);
        $optionsResolver->setAllowedTypes('pagination', 'bool');
        $optionsResolver->setAllowedTypes('pagination_page', 'int');
        $optionsResolver->setAllowedTypes('pagination_limit', 'int');
    }

    public function getParent(): ?string
    {
        return null;
    }
}
