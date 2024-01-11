<?php
// api/src/Filter/RegexpFilter.php

namespace App\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;

class CustomAndFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $propertiesToSearch = ['nom', 'auteur', 'editeur'];

        if ($property !== 'search') {
            return;
        }

        $orX = $queryBuilder->expr()->orX();

        foreach ($propertiesToSearch as $prop) {
            if (!$this->isPropertyEnabled($prop, $resourceClass) || !$this->isPropertyMapped($prop, $resourceClass)) {
                return;
            }

            $parameterName = $queryNameGenerator->generateParameterName($prop);
            $orX->add($queryBuilder->expr()->like(sprintf('%s.%s', $rootAlias, $prop), ':' . $parameterName));
            $queryBuilder->setParameter($parameterName, "%" . $value . "%");
        }

        $queryBuilder->andWhere($orX);
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'search' => [
                'property' => null, // The property to be used for the search
                'type' => 'string', // The type of the search value
                'required' => false, // Whether the search parameter is required
                'swagger' => [
                    'description' => 'Global search across multiple properties', // Swagger documentation
                    'name' => 'Search',
                    'type' => 'string',
                ],
            ],
        ];
    }
}