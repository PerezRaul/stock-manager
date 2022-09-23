<?php

declare(strict_types=1);

namespace Src\Products\Domain;

use Src\Shared\Domain\Aggregate\AggregateRoot;
use Src\Shared\Domain\Products\ProductId;
use Src\Products\Domain\Events\ProductCreated;
use Src\Products\Domain\Events\ProductUpdated;

final class Product extends AggregateRoot
{
    public function __construct(
        protected ProductId $id,
        protected ProductName $name,
        protected ProductStock $stock,
        protected ProductCreatedAt $createdAt,
        protected ProductUpdatedAt $updatedAt,
    ) {
    }

    public static function create(
        ProductId $id,
        ProductName $name,
        ProductStock $stock,
        ProductCreatedAt $createdAt,
        ProductUpdatedAt $updatedAt,
    ): self {
        $task = new self(
            $id,
            $name,
            $stock,
            $createdAt,
            $updatedAt,
        );

        $task->wasRecentlyCreated = true;

        $task->record(new ProductCreated(
            $id->value(),
            $name->value(),
            $stock->value(),
            $createdAt->__toString(),
            $updatedAt->__toString(),
        ));

        return $task;
    }

    public static function fromPrimitives(array $primitives): self
    {
        return new self(
            new ProductId($primitives['id']),
            new ProductName($primitives['name']),
            new ProductStock($primitives['stock']),
            new ProductCreatedAt($primitives['created_at']),
            new ProductUpdatedAt($primitives['updated_at']),
        );
    }

    public function update(
        ProductId|ProductName|ProductStock|ProductUpdatedAt ...$data
    ): void {
        $this->applyChanges(...$data);

        $this->recordOnChanges(new ProductUpdated(
            $this->id->value(),
            $this->name->value(),
            $this->stock->value(),
            $this->createdAt->__toString(),
            $this->updatedAt->__toString(),
            $this->changes(),
        ));
    }

    public function toPrimitives(): array
    {
        return [
            'id'         => $this->id->value(),
            'name'       => $this->name->value(),
            'stock'      => $this->stock->value(),
            'created_at' => $this->createdAt->__toString(),
            'updated_at' => $this->updatedAt->__toString(),
        ];
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function stock(): ProductStock
    {
        return $this->stock;
    }

    public function createdAt(): ProductCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ProductUpdatedAt
    {
        return $this->updatedAt;
    }
}
