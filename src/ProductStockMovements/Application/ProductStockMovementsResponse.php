<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application;

use Src\Shared\Domain\Bus\Query\Response;

final class ProductStockMovementsResponse implements Response
{
    private array $productStockMovements;

    public function __construct(ProductStockMovementResponse ...$productStockMovements)
    {
        $this->productStockMovements = $productStockMovements;
    }

    public function productStockMovements(): array
    {
        return $this->productStockMovements;
    }
}
