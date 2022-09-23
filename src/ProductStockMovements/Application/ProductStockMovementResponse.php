<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application;


use Src\ProductStockMovements\Domain\ProductStockMovementType;
use Src\Shared\Domain\Bus\Query\Response;
use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\ProductStockMovements\Domain\ProductStockMovementCreatedAt;
use Src\ProductStockMovements\Domain\ProductStockMovementAmount;
use Src\ProductStockMovements\Domain\ProductStockMovementProductId;
use Src\ProductStockMovements\Domain\ProductStockMovementUpdatedAt;

final class ProductStockMovementResponse implements Response
{
    public function __construct(
        private ProductStockMovementId $id,
        private ProductStockMovementProductId $productId,
        private ProductStockMovementType $type,
        private ProductStockMovementAmount $amount,
        private ProductStockMovementCreatedAt $createdAt,
        private ProductStockMovementUpdatedAt $updatedAt,
    ) {
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function productId(): string
    {
        return $this->productId->value();
    }

    public function type(): string
    {
        return $this->type->value();
    }

    public function amount(): int
    {
        return $this->amount->value();
    }

    public function createdAt(): string
    {
        return $this->createdAt->__toString();
    }

    public function updatedAt(): string
    {
        return $this->updatedAt->__toString();
    }
}
