<?php

declare(strict_types=1);

namespace Src\Products\Domain\Filters;

use Src\Shared\Domain\Criteria\FilterParserFactory;

final class ProductFilterParserFactory extends FilterParserFactory
{
    protected static function mapping(): array
    {
        return [
            'search' => SearchFilterParser::class,
        ];
    }
}
