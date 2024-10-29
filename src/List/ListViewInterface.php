<?php

namespace Jeandanyel\ListBundle\List;

interface ListViewInterface
{
    public function getTemplatePath(): string;

    public function getColumns(): array;

    public function getData(): array;

    public function getTotal(): int;
}
