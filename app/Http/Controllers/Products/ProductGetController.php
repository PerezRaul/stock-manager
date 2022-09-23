<?php

declare(strict_types=1);

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Src\Products\Application\Find\FindProductQuery;
use Src\Products\Application\ProductResponse;
use Illuminate\Http\JsonResponse;

final class ProductGetController extends Controller
{
    public function __invoke(string $productId): JsonResponse
    {
        /** @var ProductResponse $product */
        $product = $this->ask(new FindProductQuery($productId));

        return new JsonResponse([
            'data' => [
                'id'         => $product->id(),
                'name'       => $product->name(),
                'stock'      => $product->stock(),
                'created_at' => $product->createdAt(),
                'updated_at' => $product->updatedAt(),
            ],
        ], JsonResponse::HTTP_OK);
    }
}
