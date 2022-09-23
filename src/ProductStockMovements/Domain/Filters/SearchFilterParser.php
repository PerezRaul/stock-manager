<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain\Filters;

use Src\Shared\Domain\Criteria\FilterOperator;
use Src\Shared\Domain\Criteria\FilterParser;

final class SearchFilterParser extends FilterParser
{
    public static function get(mixed $value): ?array
    {
        return [
            [
                'field'    => 'type',
                'operator' => FilterOperator::EQUALS,
                'value'    => $value,
            ],
        ];
    }
}
