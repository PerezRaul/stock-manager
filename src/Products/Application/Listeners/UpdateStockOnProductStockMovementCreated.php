<?php

declare(strict_types=1);

namespace Src\Products\Application\Listeners;

use Src\Products\Domain\ProductRepository;
use Src\Products\Domain\ProductUpdatedAt;
use Src\ProductStockMovements\Domain\Events\ProductStockMovementCreated;
use Src\ProductStockMovements\Domain\Events\ProductStockMovementUpdated;
use Src\ProductStockMovements\Domain\ProductStockMovementType;
use Src\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Src\Shared\Domain\Bus\Event\EventBus;
use Src\Shared\Domain\Bus\Event\ShouldNotQueue;
use Src\Shared\Domain\Products\ProductId;

final class UpdateStockOnProductStockMovementCreated implements DomainEventSubscriber, ShouldNotQueue
{
    public function __construct(
        private ProductRepository $repository,
        private EventBus $eventBus,
    ) {
    }

    public static function subscribedTo(): array
    {
        return [
            ProductStockMovementCreated::class,
        ];
    }

    public function __invoke(ProductStockMovementCreated $event): void
    {
        $product = $this->repository->search(new ProductId($event->productId()));

        if (null === $product) {
            return;
        }

        if ($event->type() === ProductStockMovementType::SALE) {
            $product->update(
                $product->stock()->substract($event->amount()),
                ProductUpdatedAt::now(),
            );
        } elseif (
            $event->type() === ProductStockMovementType::ADD_STOCK ||
            $event->type() === ProductStockMovementType::SALE_CANCELED
        ) {
            $product->update(
                $product->stock()->add($event->amount()),
                ProductUpdatedAt::now(),
            );
        }

        $this->repository->save($product);
        $this->eventBus->publish(...$product->pullDomainEvents());
    }
}
