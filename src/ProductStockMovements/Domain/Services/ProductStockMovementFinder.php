<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain\Services;

use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\ProductStockMovements\Domain\ProductStockMovement;
use Src\ProductStockMovements\Domain\ProductStockMovementRepository;
use Src\Shared\Domain\Exceptions\NotExists;

final class ProductStockMovementFinder
{
    public function __construct(private ProductStockMovementRepository $repository)
    {
    }

    public function __invoke(ProductStockMovementId $id): ProductStockMovement
    {
        return $this->repository->search($id) ?? throw new NotExists(ProductStockMovement::class, $id);
    }
}
