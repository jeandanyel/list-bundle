<?php

namespace Jeandanyel\ListBundle\List;

class GridJsListView implements ListViewInterface
{
    private ListInterface $list;

    public function getTemplatePath(): string
    {
        return '@JeandanyelList/list/_grid_js_list.html.twig';
    }

    public function setList(ListInterface $list): self
    {
        $this->list = $list;

        return $this;
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
}
