<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\Put;

use Src\Shared\Domain\Bus\Command\Command;

final class PutProductStockMovementCommand implements Command
{
    public function __construct(
        private string $id,
        private string $productId,
        private string $type,
        private int $amount,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function amount(): int
    {
        return $this->amount;
    }
}
