<?php

namespace Jeandanyel\ListBundle\List;

use Symfony\Component\HttpFoundation\Request;

class GridJsList extends AbstractList
{
    public function createView(): GridJsListView
    {
        $listView = new GridJsListView();

        $listView->setList($this);

        return $listView;;
    }
}
