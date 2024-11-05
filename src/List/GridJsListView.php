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
            $sort = false;

            if ($column->isSortable()) {
                $sort = true;

                if ($column->getOrder()) {
                    $sort = ['direction' => 'asc'];
                }
            }

            $array[] = [
                'id' => $column->getName(),
                'name' => $column->getLabel(),
                'sort' => $sort,
            ];
        }

        return $array;
    }

    public function isFetchDataFromRequest(): bool
    {
        return $this->list->isFetchDataFromRequest();
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
