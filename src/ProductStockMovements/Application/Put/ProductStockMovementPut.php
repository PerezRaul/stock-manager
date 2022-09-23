<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Application\Put;

use Src\ProductStockMovements\Domain\ProductStockMovementType;
use Src\Shared\Domain\Bus\Event\EventBus;
use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\ProductStockMovements\Domain\ProductStockMovement;
use Src\ProductStockMovements\Domain\ProductStockMovementCreatedAt;
use Src\ProductStockMovements\Domain\ProductStockMovementAmount;
use Src\ProductStockMovements\Domain\ProductStockMovementRepository;
use Src\ProductStockMovements\Domain\ProductStockMovementProductId;
use Src\ProductStockMovements\Domain\ProductStockMovementUpdatedAt;

final class ProductStockMovementPut
{
    public function __construct(
        private ProductStockMovementRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function __invoke(
        ProductStockMovementId $id,
        ProductStockMovementProductId $productId,
        ProductStockMovementType $type,
        ProductStockMovementAmount $amount,
    ): void {
        $productStockMovement = $this->repository->search($id);

        $productStockMovement = null === $productStockMovement ?
            $this->create(
                $id,
                $productId,
                $type,
                $amount,
            ) :
            $this->update(
                $productStockMovement,
                $productId,
                $type,
                $amount,
            );

        $this->repository->save($productStockMovement);
        $this->eventBus->publish(...$productStockMovement->pullDomainEvents());
    }

    private function create(
        ProductStockMovementId $id,
        ProductStockMovementProductId $productId,
        ProductStockMovementType $type,
        ProductStockMovementAmount $amount,
    ): ProductStockMovement {
        return ProductStockMovement::create(
            $id,
            $productId,
            $type,
            $amount,
            ProductStockMovementCreatedAt::now(),
            ProductStockMovementUpdatedAt::now(),
        );
    }

    private function update(
        ProductStockMovement $productStockMovement,
        ProductStockMovementProductId $productId,
        ProductStockMovementType $type,
        ProductStockMovementAmount $amount,
    ): ProductStockMovement {
        $productStockMovement->update(
            $productId,
            $type,
            $amount,
            ProductStockMovementUpdatedAt::now(),
        );

        return $productStockMovement;
    }
}
