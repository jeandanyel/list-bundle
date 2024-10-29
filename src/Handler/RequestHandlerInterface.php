<?php

namespace Jeandanyel\ListBundle\Handler;

use Jeandanyel\ListBundle\List\ListInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface RequestHandlerInterface
{
    public function handle(ListInterface $list, Request $request): void;

    public function getResponse(ListInterface $list): Response;
}