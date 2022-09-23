<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\Put;

use Src\ProductStockMovements\Domain\ProductStockMovementType;
use Src\Shared\Domain\Bus\Command\CommandHandler;
use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\ProductStockMovements\Domain\ProductStockMovementAmount;
use Src\ProductStockMovements\Domain\ProductStockMovementProductId;

final class PutProductStockMovementCommandHandler implements CommandHandler
{
    public function __construct(private ProductStockMovementPut $putter)
    {
    }

    public function __invoke(PutProductStockMovementCommand $command): void
    {
        $id        = new ProductStockMovementId($command->id());
        $productId = new ProductStockMovementProductId($command->productId());
        $type      = new ProductStockMovementType($command->type());
        $amount    = new ProductStockMovementAmount($command->amount());

        $this->putter->__invoke(
            $id,
            $productId,
            $type,
            $amount,
        );
    }
}
