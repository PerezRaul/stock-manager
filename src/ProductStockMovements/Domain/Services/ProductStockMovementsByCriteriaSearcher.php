<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain\Services;

use Src\ProductStockMovements\Domain\ProductStockMovementRepository;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Groups;
use Src\Shared\Domain\Criteria\Orders;
use Src\ProductStockMovements\Domain\ProductStockMovements;

final class ProductStockMovementsByCriteriaSearcher
{
    public function __construct(private ProductStockMovementRepository $repository)
    {
    }

    public function __invoke(Filters $filters, Orders $orders, ?int $limit, ?int $offset): ProductStockMovements
    {
        $criteria = new Criteria($filters, $orders, new Groups([]), $offset, $limit);

        return $this->repository->matching($criteria);
    }
}
