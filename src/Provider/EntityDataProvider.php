<?php

namespace Jeandanyel\ListBundle\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Jeandanyel\ListBundle\List\ListInterface;

class EntityDataProvider implements DataProviderInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function getData(ListInterface $list): array
    {
        $repository = $this->entityManager->getRepository($list->getEntityClass());
        $data = [];

        if ($list->getQueryBuilder()) {
            $callable = $list->getQueryBuilder();
            $queryBuilder = $callable($repository);
        } else {
            $queryBuilder = $repository->createQueryBuilder('e');
        }

        $result = $queryBuilder->getQuery()->getResult();

        foreach ($result as $index => $entity) {
            $data[$index] = [];

            foreach ($list->getColumns() as $column) {
                $data[$index][$column->getName()] = (string) $column->getValue($entity, $column->getName());
            }
        }

        return $data;
    }
}
