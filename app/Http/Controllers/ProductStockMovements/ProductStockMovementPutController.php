<?php

declare(strict_types=1);

namespace App\Http\Controllers\ProductStockMovements;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStockMovements\ProductStockMovementPutRequest;
use Illuminate\Http\JsonResponse;
use Src\ProductStockMovements\Application\Put\PutProductStockMovementCommand;
use Src\Shared\Domain\ArrUtils;
use Src\Shared\Domain\StrUtils;


final class ProductStockMovementPutController extends Controller
{
    public function __invoke(ProductStockMovementPutRequest $request, string $productStockMovementId): JsonResponse
    {
        $validated = ArrUtils::mapWithKeys(function ($value, $key) {
            return [StrUtils::camel($key) => $value];
        }, $request->validated());

        $this->dispatch(new PutProductStockMovementCommand($productStockMovementId, ...$validated));

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
