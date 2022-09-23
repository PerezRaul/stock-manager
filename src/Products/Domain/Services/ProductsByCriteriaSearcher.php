<?php

declare(strict_types=1);

namespace Src\Products\Domain\Services;

use Src\Products\Domain\ProductRepository;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Groups;
use Src\Shared\Domain\Criteria\Orders;
use Src\Products\Domain\Products;

final class ProductsByCriteriaSearcher
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function __invoke(Filters $filters, Orders $orders, ?int $limit, ?int $offset): Products
    {
        $criteria = new Criteria($filters, $orders, new Groups([]), $offset, $limit);

        return $this->repository->matching($criteria);
    }
}
