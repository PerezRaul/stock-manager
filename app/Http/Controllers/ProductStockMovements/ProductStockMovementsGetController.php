<?php

declare(strict_types=1);

namespace App\Http\Controllers\ProductStockMovements;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pagination;
use App\Http\Requests\ProductStockMovements\ProductStockMovementsGetRequest;
use Illuminate\Http\JsonResponse;
use Src\ProductStockMovements\Application\CountByCriteria\CountProductStockMovementsByCriteriaQuery;
use Src\ProductStockMovements\Application\ProductStockMovementResponse;
use Src\ProductStockMovements\Application\ProductStockMovementsResponse;
use Src\ProductStockMovements\Application\SearchByCriteria\SearchProductStockMovementsByCriteriaQuery;
use Src\ProductStockMovements\Domain\Filters\ProductStockMovementFilterParserFactory;
use Src\Shared\Application\CounterResponse;
use Src\Shared\Domain\ArrUtils;

use function Lambdish\Phunctional\map;

final class ProductStockMovementsGetController extends Controller
{
    use Pagination;

    public function __invoke(ProductStockMovementsGetRequest $request): JsonResponse
    {
        $filters = ProductStockMovementFilterParserFactory::get(array_merge(
            ArrUtils::except($request->validated(), 'page', 'per_page'),
            [],
        ));

        /** @var CounterResponse $numberProductStockMovements */
        $numberProductStockMovements = $this->ask(new CountProductStockMovementsByCriteriaQuery($filters));

        if ($numberProductStockMovements->total() === 0) {
            return $this->emptyResponse($request);
        }

        /** @var ProductStockMovementsResponse $productStockMovements */
        $productStockMovements = $this->ask(new SearchProductStockMovementsByCriteriaQuery(
            $filters,
            [['created_at', 'asc']],
            $this->perPage($request),
            $this->offset($request)
        ));

        return new JsonResponse([
            'data' => map(
                $this->productStockMovementResponse(),
                $productStockMovements->productStockMovements()
            ),
            'meta' => $this->paginationMeta(
                $numberProductStockMovements->total(),
                $this->perPage($request),
                $this->page($request)
            ),
        ], JsonResponse::HTTP_OK);
    }

    private function productStockMovementResponse(): callable
    {
        return fn(ProductStockMovementResponse $productStockMovement) => [
            'id'         => $productStockMovement->id(),
            'product_id' => $productStockMovement->productId(),
            'type'       => $productStockMovement->type(),
            'amount'     => $productStockMovement->amount(),
            'created_at' => $productStockMovement->createdAt(),
            'updated_at' => $productStockMovement->updatedAt(),
        ];
    }
}
