<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain;

use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;

interface ProductStockMovementRepository
{
    public function save(ProductStockMovement $task): void;

    public function search(ProductStockMovementId $id): ?ProductStockMovement;

    public function matching(Criteria $criteria): ProductStockMovements;

    public function matchingCount(Criteria $criteria): int;

    public function delete(ProductStockMovementId $id): void;
}
