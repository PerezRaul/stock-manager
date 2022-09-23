<?php

declare(strict_types=1);

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pagination;
use App\Http\Requests\Products\ProductsGetRequest;
use Illuminate\Http\JsonResponse;
use Src\Products\Application\CountByCriteria\CountProductsByCriteriaQuery;
use Src\Products\Application\ProductResponse;
use Src\Products\Application\ProductsResponse;
use Src\Products\Application\SearchByCriteria\SearchProductsByCriteriaQuery;
use Src\Products\Domain\Filters\ProductFilterParserFactory;
use Src\Shared\Application\CounterResponse;
use Src\Shared\Domain\ArrUtils;

use function Lambdish\Phunctional\map;

final class ProductsGetController extends Controller
{
    use Pagination;

    public function __invoke(ProductsGetRequest $request): JsonResponse
    {
        $filters = ProductFilterParserFactory::get(array_merge(
            ArrUtils::except($request->validated(), 'page', 'per_page'),
            [],
        ));

        /** @var CounterResponse $numberProducts */
        $numberProducts = $this->ask(new CountProductsByCriteriaQuery($filters));

        if ($numberProducts->total() === 0) {
            return $this->emptyResponse($request);
        }

        /** @var ProductsResponse $products */
        $products = $this->ask(new SearchProductsByCriteriaQuery(
            $filters,
            [['name', 'asc']],
            $this->perPage($request),
            $this->offset($request)
        ));

        return new JsonResponse([
            'data' => map(
                $this->productResponse(),
                $products->products()
            ),
            'meta' => $this->paginationMeta(
                $numberProducts->total(),
                $this->perPage($request),
                $this->page($request)
            ),
        ], JsonResponse::HTTP_OK);
    }

    private function productResponse(): callable
    {
        return fn(ProductResponse $product) => [
            'id'         => $product->id(),
            'name'       => $product->name(),
            'stock'      => $product->stock(),
            'created_at' => $product->createdAt(),
            'updated_at' => $product->updatedAt(),
        ];
    }
}
