<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain\Filters;

use Src\Shared\Domain\Criteria\FilterOperator;
use Src\Shared\Domain\Criteria\FilterParser;

final class ProductIdFilterParser extends FilterParser
{
    public static function get(mixed $value): ?array
    {
        return [
            [
                'field'    => 'product_id',
                'operator' => FilterOperator::EQUAL,
                'value'    => $value,
            ],
        ];
    }
}
