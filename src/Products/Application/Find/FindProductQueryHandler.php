<?php

declare(strict_types=1);

namespace Src\Products\Application\Find;

use Src\Shared\Domain\Products\ProductId;
use Src\Products\Application\ProductResponse;
use Src\Products\Domain\Services\ProductFinder;
use Src\Shared\Domain\Bus\Query\QueryHandler;

final class FindProductQueryHandler implements QueryHandler
{
    public function __construct(private ProductFinder $finder)
    {
    }

    public function __invoke(FindProductQuery $query): ProductResponse
    {
        $product = $this->finder->__invoke(new ProductId($query->id()));

        return new ProductResponse(
            $product->id(),
            $product->name(),
            $product->stock(),
            $product->createdAt(),
            $product->updatedAt(),
        );
    }
}
