<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;

interface ListInterface
{
    public function setEntityClass(?string $entityClass = null): self;

    public function getEntityClass(): ?string;

    public function setDataProvider(DataProviderInterface $dataProvider): self;

    public function getDataProvider(): DataProviderInterface;

    public function getQueryBuilder(): ?callable;

    public function setQueryBuilder(?callable $queryBuilder): self;

    public function addColumn(Column $column): self;

    /**
     * @return array<string, Column>
     */
    public function getColumns(): array;

    public function getData(): array;

    public function createView(): ListViewInterface;
}
