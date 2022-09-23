<?php

declare(strict_types=1);

namespace Src\Products\Application\SearchByCriteria;

use Src\Products\Application\ProductResponse;
use Src\Products\Application\ProductsResponse;
use Src\Products\Domain\Product;
use Src\Products\Domain\Services\ProductsByCriteriaSearcher;
use Src\Shared\Domain\Bus\Query\QueryHandler;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Orders;

use function Lambdish\Phunctional\map;

final class SearchProductsByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private ProductsByCriteriaSearcher $searcher)
    {
    }

    public function __invoke(SearchProductsByCriteriaQuery $query): ProductsResponse
    {
        $filters = Filters::fromValues($query->filters());
        $orders  = Orders::fromValues($query->orders());

        $products = $this->searcher->__invoke($filters, $orders, $query->limit(), $query->offset());

        return new ProductsResponse(...map($this->toResponse(), $products));
    }

    private function toResponse(): callable
    {
        return fn(Product $product) => new ProductResponse(
            $product->id(),
            $product->name(),
            $product->stock(),
            $product->createdAt(),
            $product->updatedAt(),
        );
    }
}
