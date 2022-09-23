<?php

declare(strict_types=1);

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;

use App\Http\Requests\Products\ProductPutRequest;
use Illuminate\Http\JsonResponse;
use Src\Products\Application\Put\PutProductCommand;
use Src\Shared\Domain\ArrUtils;
use Src\Shared\Domain\StrUtils;


final class ProductPutController extends Controller
{
    public function __invoke(ProductPutRequest $request, string $productId): JsonResponse
    {
        $validated = ArrUtils::mapWithKeys(function ($value, $key) {
            return [StrUtils::camel($key) => $value];
        }, $request->validated());

        $this->dispatch(new PutProductCommand($productId, ...$validated));

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
