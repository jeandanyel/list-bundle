<?php

namespace Jeandanyel\ListBundle\Handler;

use Jeandanyel\ListBundle\List\ListInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GridJsRequestHandler implements RequestHandlerInterface
{
    public function handle(ListInterface $list, Request $request): void
    {
        if ($list->getPagination() !== null) {
            $page = $request->query->get('page');

            $list->getPagination()->setPage($page + 1);
        }
    }

    public function getResponse(ListInterface $list): Response
    {
        $listView = $list->createView();

        return new JsonResponse([
            'data' => $listView->getData(),
            'total' => $listView->getTotal(),
        ]);
    }
}