<?php

declare(strict_types=1);

namespace Src\Products\Domain\Services;

use Src\Shared\Domain\Products\ProductId;
use Src\Products\Domain\Product;
use Src\Products\Domain\ProductRepository;
use Src\Shared\Domain\Exceptions\NotExists;

final class ProductFinder
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function __invoke(ProductId $id): Product
    {
        return $this->repository->search($id) ?? throw new NotExists(Product::class, $id);
    }
}
