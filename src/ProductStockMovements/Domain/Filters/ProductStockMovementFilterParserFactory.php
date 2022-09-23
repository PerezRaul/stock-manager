<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain\Filters;

use Src\Shared\Domain\Criteria\FilterParserFactory;

final class ProductStockMovementFilterParserFactory extends FilterParserFactory
{
    protected static function mapping(): array
    {
        return [
            'product_id' => ProductIdFilterParser::class,
            'search'     => ProductIdFilterParser::class,
        ];
    }
}
