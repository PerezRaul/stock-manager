<?php

declare(strict_types=1);

namespace Src\Products\Application\Put;

use Src\Shared\Domain\Bus\Event\EventBus;
use Src\Shared\Domain\Products\ProductId;
use Src\Products\Domain\Product;
use Src\Products\Domain\ProductCreatedAt;
use Src\Products\Domain\ProductStock;
use Src\Products\Domain\ProductRepository;
use Src\Products\Domain\ProductName;
use Src\Products\Domain\ProductUpdatedAt;

final class ProductPut
{
    public function __construct(
        private ProductRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function __invoke(
        ProductId $id,
        ProductName $name,
        ProductStock $stock,
    ): void {
        $product = $this->repository->search($id);

        $product = null === $product ?
            $this->create(
                $id,
                $name,
                $stock,
            ) :
            $this->update(
                $product,
                $name,
                $stock,
            );

        $this->repository->save($product);
        $this->eventBus->publish(...$product->pullDomainEvents());
    }

    private function create(
        ProductId $id,
        ProductName $name,
        ProductStock $stock,
    ): Product {
        return Product::create(
            $id,
            $name,
            $stock,
            ProductCreatedAt::now(),
            ProductUpdatedAt::now(),
        );
    }

    private function update(
        Product $product,
        ProductName $name,
        ProductStock $stock,
    ): Product {
        $product->update(
            $name,
            $stock,
            ProductUpdatedAt::now(),
        );

        return $product;
    }
}
