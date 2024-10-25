<?php

namespace Jeandanyel\ListBundle\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Jeandanyel\ListBundle\List\ListInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class DataProvider implements DataProviderInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private PropertyAccessorInterface $propertyAccessor,
    ) {}

    public function getData(ListInterface $list): array
    {
        $repository = $this->entityManager->getRepository($list->getEntityClass());
        $data = [];

        foreach ($repository->findAll() as $index => $entity) {
            $data[$index] = [];

            foreach ($list->getColumns() as $column) {
                $data[$index][$column->getName()] = (string) $this->propertyAccessor->getValue($entity, $column->getName());
            }
        }

        return $data;
    }
}
