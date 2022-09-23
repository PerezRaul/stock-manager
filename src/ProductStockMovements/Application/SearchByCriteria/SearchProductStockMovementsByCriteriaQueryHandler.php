<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\SearchByCriteria;

use Src\ProductStockMovements\Application\ProductStockMovementResponse;
use Src\ProductStockMovements\Application\ProductStockMovementsResponse;
use Src\ProductStockMovements\Domain\ProductStockMovement;
use Src\ProductStockMovements\Domain\Services\ProductStockMovementsByCriteriaSearcher;
use Src\Shared\Domain\Bus\Query\QueryHandler;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Orders;

use function Lambdish\Phunctional\map;

final class SearchProductStockMovementsByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private ProductStockMovementsByCriteriaSearcher $searcher)
    {
    }

    public function __invoke(SearchProductStockMovementsByCriteriaQuery $query): ProductStockMovementsResponse
    {
        $filters = Filters::fromValues($query->filters());
        $orders  = Orders::fromValues($query->orders());

        $productStockMovements = $this->searcher->__invoke($filters, $orders, $query->limit(), $query->offset());

        return new ProductStockMovementsResponse(...map($this->toResponse(), $productStockMovements));
    }

    private function toResponse(): callable
    {
        return fn(ProductStockMovement $productStockMovement) => new ProductStockMovementResponse(
            $productStockMovement->id(),
            $productStockMovement->productId(),
            $productStockMovement->type(),
            $productStockMovement->amount(),
            $productStockMovement->createdAt(),
            $productStockMovement->updatedAt(),
        );
    }
}
