<?php

declare(strict_types=1);

namespace Src\Products\Application\CountByCriteria;

use Src\Shared\Application\CounterResponse;
use Src\Shared\Domain\Bus\Query\QueryHandler;
use Src\Shared\Domain\Criteria\Filters;

final class CountProductsByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private ProductsByCriteriaCounter $counter)
    {
    }

    public function __invoke(CountProductsByCriteriaQuery $query): CounterResponse
    {
        $filters = Filters::fromValues($query->filters());

        return new CounterResponse($this->counter->__invoke($filters));
    }
}
