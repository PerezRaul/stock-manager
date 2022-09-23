<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\Find;

use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\ProductStockMovements\Application\ProductStockMovementResponse;
use Src\ProductStockMovements\Domain\Services\ProductStockMovementFinder;
use Src\Shared\Domain\Bus\Query\QueryHandler;

final class FindProductStockMovementQueryHandler implements QueryHandler
{
    public function __construct(private ProductStockMovementFinder $finder)
    {
    }

    public function __invoke(FindProductStockMovementQuery $query): ProductStockMovementResponse
    {
        $productStockMovement = $this->finder->__invoke(new ProductStockMovementId($query->id()));

        return new ProductStockMovementResponse(
            $productStockMovement->id(),
            $productStockMovement->productId(),
            $productStockMovement->type(),
            $productStockMovement->amount(),
            $productStockMovement->createdAt(),
            $productStockMovement->updatedAt(),
        );
    }
}
