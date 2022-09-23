<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain;

use Src\Shared\Domain\Collection;

final class ProductStockMovements extends Collection
{
    protected function types(): array
    {
        return [
            ProductStockMovement::class,
        ];
    }
}
