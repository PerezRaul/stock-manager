<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\CountByCriteria;

use Src\ProductStockMovements\Domain\ProductStockMovementRepository;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Groups;
use Src\Shared\Domain\Criteria\Orders;

final class ProductStockMovementsByCriteriaCounter
{
    public function __construct(private ProductStockMovementRepository $repository)
    {
    }

    public function __invoke(Filters $filters): int
    {
        $criteria = new Criteria($filters, new Orders([]), new Groups([]), null, null);

        return $this->repository->matchingCount($criteria);
    }
}
