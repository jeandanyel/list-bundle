<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Handler\RequestHandlerInterface;
use Jeandanyel\ListBundle\Pagination\Pagination;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ListInterface
{
    public function getType(): ListTypeInterface;

    public function setType(ListTypeInterface $type): self;

    public function setEntityClass(?string $entityClass = null): self;

    public function getEntityClass(): ?string;

    public function setDataProvider(DataProviderInterface $dataProvider): self;

    public function getDataProvider(): DataProviderInterface;

    public function getQueryBuilder(): ?callable;

    public function setQueryBuilder(?callable $queryBuilder): self;

    public function setRequestHandler(RequestHandlerInterface $requestHandler): self;

    public function getRequestHandler(): RequestHandlerInterface;

    public function addColumn(Column $column): self;

    /**
     * @return array<string, Column>
     */
    public function getColumns(): array;

    public function getPagination(): ?Pagination;

    public function setPagination(?Pagination $pagination): self;

    public function getData(): array;

    public function createView(): ListViewInterface;

    public function handleRequest(Request $request): self;
}
