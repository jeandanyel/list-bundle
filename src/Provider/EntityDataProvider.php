<?php

namespace Jeandanyel\ListBundle\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Jeandanyel\ListBundle\Column\Column;
use Jeandanyel\ListBundle\Helper\StringHelper;
use Jeandanyel\ListBundle\List\ListInterface;

class EntityDataProvider implements DataProviderInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function getData(ListInterface $list): array
    {
        $queryBuilder = $this->getQueryBuilder($list);
        $rootAlias = $queryBuilder->getRootAliases()[0];

        if ($list->isFetchDataFromRequest() && $list->getPagination() !== null) {
            $pagination = $list->getPagination();

            $queryBuilder->setFirstResult($pagination->getOffset());
            $queryBuilder->setMaxResults($pagination->getLimit());
        }

        foreach ($list->getColumns() as $column) {
            $hasRelations = count(explode('.', $column->getName())) > 1;

            if ($hasRelations) {
                $propertyPath = $this->join($queryBuilder, $column);
            } else {
                $propertyPath = sprintf('%s.%s', $rootAlias, StringHelper::snakeToCamel($column->getName()));
            }

            if ($column->getOrder() !== null) {
                $queryBuilder->addOrderBy($propertyPath, $column->getOrder());
            }
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

    private function join(QueryBuilder $queryBuilder, Column $column): string
    {
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $propertyPath = StringHelper::snakeToCamel($column->getName());
        $relations = explode('.', $propertyPath);
        $property = array_pop($relations);
        $alias = $rootAlias;

        foreach ($relations as $relation) {
            $joins = $queryBuilder->getDQLPart('join')[$rootAlias] ?? [];

            foreach ($joins as $join) {
                if ($join->getJoin() === sprintf('%s.%s', $alias, $relation)) {
                    $alias = $join->getAlias();

                    continue 2;
                }
            }

            $relationPath = sprintf('%s.%s', $alias, $relation);
            $alias = sprintf('%s_%s', $alias, $relation);

            $queryBuilder->join($relationPath, $alias);
        }

        return sprintf('%s.%s', $alias, $property);
    }
}
