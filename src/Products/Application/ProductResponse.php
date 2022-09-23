<?php

declare(strict_types=1);

namespace Src\Products\Application;


use Src\Shared\Domain\Bus\Query\Response;
use Src\Shared\Domain\Products\ProductId;
use Src\Products\Domain\ProductCreatedAt;
use Src\Products\Domain\ProductStock;
use Src\Products\Domain\ProductName;
use Src\Products\Domain\ProductUpdatedAt;

final class ProductResponse implements Response
{
    public function __construct(
        private ProductId $id,
        private ProductName $name,
        private ProductStock $stock,
        private ProductCreatedAt $createdAt,
        private ProductUpdatedAt $updatedAt,
    ) {
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function stock(): int
    {
        return $this->stock->value();
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
