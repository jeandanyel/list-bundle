<?php

namespace Jeandanyel\ListBundle\Builder;

use Jeandanyel\ListBundle\Factory\ColumnFactoryInterface;
use Jeandanyel\ListBundle\List\ListInterface;
use Jeandanyel\ListBundle\List\ResolvedListTypeInterface;
use Jeandanyel\ListBundle\Mapper\RequestHandlerMapper;
use Jeandanyel\ListBundle\Pagination\Pagination;

class ListBuilder implements ListBuilderInterface
{
    private ResolvedListTypeInterface $type;
    private $unresolvedColumns = [];

    public function __construct(
        private ColumnFactoryInterface $columnFactory,
        private RequestHandlerMapper $requestHandlerMapper,
        private array $options = [],
    ) {}

    public function setType(ResolvedListTypeInterface $type): self
    {
        $this->type = $type;
    
        return $this;
    }

    public function getType(): ResolvedListTypeInterface
    {
        return $this->type;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function add(string $name, string $columnTypeClass, array $options = []): self
    {
        $this->unresolvedColumns[$name] = [$columnTypeClass, $options];

        return $this;
    }

    public function getList(): ListInterface
    {
        $listClass = $this->options['list_class'];
    
        if (!class_exists($listClass)) {
            throw new \RuntimeException("The class $listClass does not exist.");
        }

        $list = new $listClass();

        $list->setType($this->type->getInnerType());
        $list->setEntityClass($this->options['entity_class']);
        $list->setDataProvider($this->options['data_provider']);
        $list->setQueryBuilder($this->options['query_builder']);

        $requestHandler = $this->options['request_handler'];

        if (!$requestHandler) {
            $requestHandler = $this->requestHandlerMapper->get($listClass);
        }
        
        $list->setRequestHandler($requestHandler);

        if ($this->options['pagination'] === true) {
            $pagination = new Pagination();

            $pagination->setPage($this->options['pagination_page']);
            $pagination->setLimit($this->options['pagination_limit']);

            $list->setPagination($pagination);
        }
        
        foreach ($this->unresolvedColumns as $name => [$columnTypeClass, $options]) {
            $column = $this->columnFactory->create($name, $columnTypeClass, $options);

            $list->addColumn($column);
        }

        return $list;
    }
}
