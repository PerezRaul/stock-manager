<?php

declare(strict_types=1);

namespace Src\Products\Domain;

use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Products\ProductId;

interface ProductRepository
{
    public function save(Product $task): void;

    public function search(ProductId $id): ?Product;

    public function matching(Criteria $criteria): Products;

    public function matchingCount(Criteria $criteria): int;
}
