<?php

namespace Jeandanyel\ListBundle\Controller;

use Jeandanyel\ListBundle\Factory\ListFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{
    public function __construct(private ListFactoryInterface $listFactory) {}

    public function getData(Request $request): Response
    {
        $listTypeClass = $request->request->get('list_type_class');
        $list = $this->listFactory->create($listTypeClass);

        $list->handleRequest($request);

        return $list->getRequestHandler()->getResponse($list);
    }
}
