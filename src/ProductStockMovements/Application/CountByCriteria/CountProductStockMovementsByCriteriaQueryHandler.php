<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\CountByCriteria;

use Src\Shared\Application\CounterResponse;
use Src\Shared\Domain\Bus\Query\QueryHandler;
use Src\Shared\Domain\Criteria\Filters;

final class CountProductStockMovementsByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private ProductStockMovementsByCriteriaCounter $counter)
    {
    }

    public function __invoke(CountProductStockMovementsByCriteriaQuery $query): CounterResponse
    {
        $filters = Filters::fromValues($query->filters());

        return new CounterResponse($this->counter->__invoke($filters));
    }
}
