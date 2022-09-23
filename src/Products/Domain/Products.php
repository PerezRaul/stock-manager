<?php

declare(strict_types=1);

namespace Src\Products\Domain;

use Src\Shared\Domain\Collection;

final class Products extends Collection
{
    protected function types(): array
    {
        return [
            Product::class,
        ];
    }
}
