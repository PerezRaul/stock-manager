<?php

declare(strict_types=1);

namespace Src\Products\Application\CountByCriteria;

use Src\Products\Domain\ProductRepository;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Groups;
use Src\Shared\Domain\Criteria\Orders;

final class ProductsByCriteriaCounter
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function __invoke(Filters $filters): int
    {
        $criteria = new Criteria($filters, new Orders([]), new Groups([]), null, null);

        return $this->repository->matchingCount($criteria);
    }
}
