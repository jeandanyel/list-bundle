<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Handler\RequestHandlerInterface;
use Jeandanyel\ListBundle\Pagination\Pagination;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractList implements ListInterface
{
    private ListTypeInterface $type;

    private ?string $entityClass = null;

    private DataProviderInterface $dataProvider;

    /**
     * @var callable|null
     */
    private $queryBuilder = null;

    private RequestHandlerInterface $requestHandler;

    /**
     * @var array<string, Column>
     */
    private array $columns = [];

    private ?Pagination $pagination = null;

    // private ?Pagination $pagination = null;

    public function getType(): ListTypeInterface
    {
        return $this->type;
    }

    public function setType(ListTypeInterface $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    public function setEntityClass(?string $entityClass = null): self
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getDataProvider(): DataProviderInterface
    {
        return $this->dataProvider;
    }

    public function setDataProvider(DataProviderInterface $dataProvider): self
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    public function getQueryBuilder(): ?callable
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(?callable $queryBuilder): self
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    public function setRequestHandler(RequestHandlerInterface $requestHandler): self
    {
        $this->requestHandler = $requestHandler;

        return $this;
    }

    public function getRequestHandler(): RequestHandlerInterface
    {
        return $this->requestHandler;
    }

    public function addColumn(Column $column): self
    {
        $this->columns[$column->getName()] = $column;

        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getPagination(): ?Pagination
    {
        return $this->pagination;
    }

    public function setPagination(?Pagination $pagination): self
    {
        $this->pagination = $pagination;
    
        return $this;
    }

    public function getData(): array
    {
        return $this->dataProvider->getData($this);
    }

    abstract public function createView(): ListViewInterface;

    public function handleRequest(Request $request): self
    {
        $this->requestHandler->handle($this, $request);

        return $this;
    }
}