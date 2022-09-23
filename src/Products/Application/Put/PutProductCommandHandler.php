<?php

declare(strict_types=1);

namespace Src\Products\Application\Put;

use Src\Products\Domain\ProductStock;
use Src\Shared\Domain\Bus\Command\CommandHandler;
use Src\Shared\Domain\Products\ProductId;
use Src\Products\Domain\ProductName;

final class PutProductCommandHandler implements CommandHandler
{
    public function __construct(private ProductPut $putter)
    {
    }

    public function __invoke(PutProductCommand $command): void
    {
        $id    = new ProductId($command->id());
        $name  = new ProductName($command->name());
        $stock = new ProductStock(0);

        $this->putter->__invoke(
            $id,
            $name,
            $stock,
        );
    }
}
