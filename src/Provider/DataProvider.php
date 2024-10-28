<?php

namespace Jeandanyel\ListBundle\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Jeandanyel\ListBundle\List\ListInterface;

class DataProvider implements DataProviderInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function getData(ListInterface $list): array
    {
        $repository = $this->entityManager->getRepository($list->getEntityClass());
        $data = [];

        foreach ($repository->findAll() as $index => $entity) {
            $data[$index] = [];

            foreach ($list->getColumns() as $column) {
                $data[$index][$column->getName()] = (string) $column->getValue($entity, $column->getName());
            }
        }

        return $data;
    }
}
