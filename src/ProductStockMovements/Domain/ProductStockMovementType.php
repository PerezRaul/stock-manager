<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain;

use Src\Shared\Domain\ValueObject\Enum;

final class ProductStockMovementType extends Enum
{
    public const ADD_STOCK     = 'add_stock';
    public const SALE          = 'sale';
    public const SALE_CANCELED = 'sale_canceled';
}
