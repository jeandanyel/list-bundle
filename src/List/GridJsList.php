<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Provider\DataProviderInterface;

class GridJsList implements ListInterface
{
    private ?string $entityClass = null;
    private DataProviderInterface $dataProvider;

    /**
     * @var array<string, Column>
     */
    private array $columns = [];

    public function setEntityClass(?string $entityClass = null): self
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    public function setDataProvider(DataProviderInterface $dataProvider): self
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    public function getDataProvider(): DataProviderInterface
    {
        return $this->dataProvider;
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

    public function getData(): array
    {
        return $this->dataProvider->getData($this);
    }

    public function createView(): ListViewInterface
    {
        $listView = new GridJsListView();

        $listView->setList($this);

        return $listView;;
    }
}
