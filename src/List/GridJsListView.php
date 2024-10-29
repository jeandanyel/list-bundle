<?php

namespace Jeandanyel\ListBundle\List;

use Jeandanyel\ListBundle\Pagination\Pagination;

class GridJsListView implements ListViewInterface
{
    private ListInterface $list;

    public function getTemplatePath(): string
    {
        return '@JeandanyelList/list/_grid_js_list.html.twig';
    }

    public function getList(): ListInterface
    {
        return $this->list;
    }

    public function setList(ListInterface $list): self
    {
        $this->list = $list;

        return $this;
    }

    public function getType(): string
    {
        return get_class($this->list->getType());
    }

    public function getColumns(): array
    {
        $array = [];

        foreach ($this->list->getColumns() as $column) {
            $array[] = [
                'name' => $column->getLabel(),
                'sort' => $column->isSortable(),
            ];
        }

        return $array;
    }

    public function getData(): array
    {
        $array = [];

        foreach ($this->list->getData() as $row) {
            $array[] = array_values($row);
        }

        return $array;
    }

    public function getTotal(): int
    {
        $dataProvider = $this->list->getDataProvider();

        return $dataProvider->getTotal($this->list);
    }

    public function getPagination(): ?Pagination
    {
        return $this->list->getPagination();
    }
}
