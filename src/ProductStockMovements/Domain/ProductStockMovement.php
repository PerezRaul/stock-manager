<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain;

use Src\Shared\Domain\Aggregate\AggregateRoot;
use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\ProductStockMovements\Domain\Events\ProductStockMovementCreated;
use Src\ProductStockMovements\Domain\Events\ProductStockMovementUpdated;

final class ProductStockMovement extends AggregateRoot
{
    public function __construct(
        protected ProductStockMovementId $id,
        protected ProductStockMovementProductId $productId,
        protected ProductStockMovementType $type,
        protected ProductStockMovementAmount $amount,
        protected ProductStockMovementCreatedAt $createdAt,
        protected ProductStockMovementUpdatedAt $updatedAt,
    ) {
    }

    public static function create(
        ProductStockMovementId $id,
        ProductStockMovementProductId $productId,
        ProductStockMovementType $type,
        ProductStockMovementAmount $amount,
        ProductStockMovementCreatedAt $createdAt,
        ProductStockMovementUpdatedAt $updatedAt,
    ): self {
        $productStockMovement = new self(
            $id,
            $productId,
            $type,
            $amount,
            $createdAt,
            $updatedAt,
        );

        $productStockMovement->wasRecentlyCreated = true;

        $productStockMovement->record(new ProductStockMovementCreated(
            $id->value(),
            $productId->value(),
            $type->value(),
            $amount->value(),
            $createdAt->__toString(),
            $updatedAt->__toString(),
        ));

        return $productStockMovement;
    }

    public static function fromPrimitives(array $primitives): self
    {
        return new self(
            new ProductStockMovementId($primitives['id']),
            new ProductStockMovementProductId($primitives['product_id']),
            new ProductStockMovementType($primitives['type']),
            new ProductStockMovementAmount($primitives['amount']),
            new ProductStockMovementCreatedAt($primitives['created_at']),
            new ProductStockMovementUpdatedAt($primitives['updated_at']),
        );
    }

    public function update(
        ProductStockMovementId|ProductStockMovementProductId|ProductStockMovementType|ProductStockMovementAmount|ProductStockMovementUpdatedAt ...$data
    ): void {
        $this->applyChanges(...$data);

        $this->recordOnChanges(new ProductStockMovementUpdated(
            $this->id->value(),
            $this->productId->value(),
            $this->type->value(),
            $this->amount->value(),
            $this->createdAt->__toString(),
            $this->updatedAt->__toString(),
            $this->changes(),
        ));
    }

    public function toPrimitives(): array
    {
        return [
            'id'         => $this->id->value(),
            'product_id' => $this->productId->value(),
            'type'       => $this->type->value(),
            'amount'     => $this->amount->value(),
            'created_at' => $this->createdAt->__toString(),
            'updated_at' => $this->updatedAt->__toString(),
        ];
    }

    public function id(): ProductStockMovementId
    {
        return $this->id;
    }

    public function productId(): ProductStockMovementProductId
    {
        return $this->productId;
    }

    public function type(): ProductStockMovementType
    {
        return $this->type;
    }

    public function amount(): ProductStockMovementAmount
    {
        return $this->amount;
    }

    public function createdAt(): ProductStockMovementCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ProductStockMovementUpdatedAt
    {
        return $this->updatedAt;
    }
}
