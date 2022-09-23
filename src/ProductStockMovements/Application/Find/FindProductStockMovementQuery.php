<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\Find;

use Src\Shared\Domain\Bus\Query\Query;

final class FindProductStockMovementQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
