<?php

declare(strict_types=1);

namespace Src\Products\Application;

use Src\Shared\Domain\Bus\Query\Response;

final class ProductsResponse implements Response
{
    private array $products;

    public function __construct(ProductResponse ...$products)
    {
        $this->products = $products;
    }

    public function products(): array
    {
        return $this->products;
    }
}
