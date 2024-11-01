<?php

namespace Jeandanyel\ListBundle\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Jeandanyel\ListBundle\List\ListInterface;

class EntityDataProvider implements DataProviderInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function getData(ListInterface $list): array
    {
        $queryBuilder = $this->getQueryBuilder($list);

        if ($list->isFetchDataFromRequest() && $list->getPagination() !== null) {
            $pagination = $list->getPagination();

            $queryBuilder->setFirstResult($pagination->getOffset());
            $queryBuilder->setMaxResults($pagination->getLimit());
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function getTotal(ListInterface $list): int
    {
        $queryBuilder = clone $this->getQueryBuilder($list);
        $rootAlias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->select("COUNT($rootAlias.id)");

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    private function getQueryBuilder(ListInterface $list): QueryBuilder
    {
        $repository = $this->entityManager->getRepository($list->getEntityClass());

        if ($list->getQueryBuilder()) {
            $callable = $list->getQueryBuilder();

            /**
             * @var QueryBuilder
             */
            $queryBuilder = $callable($repository);
        } else {
            $queryBuilder = $repository->createQueryBuilder('e');
        }

        return $queryBuilder;
    }
}
