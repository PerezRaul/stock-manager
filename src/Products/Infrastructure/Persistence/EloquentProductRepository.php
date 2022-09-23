<?php

declare(strict_types=1);

namespace Src\Products\Infrastructure\Persistence;

use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Products\ProductId;
use Src\Shared\Infrastructure\Persistence\Eloquent\EloquentCriteriaConverter;
use Src\Shared\Infrastructure\Persistence\Eloquent\EloquentRepository;
use Src\Products\Domain\Product;
use Src\Products\Domain\ProductRepository;
use Src\Products\Domain\Products;
use Src\Products\Infrastructure\Persistence\Eloquent\Product as EloquentProduct;

use function Lambdish\Phunctional\map;

final class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        if (!$product->hasChanges()) {
            return;
        }

        EloquentProduct::updateOrCreate([
            'id' => $product->id()->value(),
        ], $product->toPrimitives());
    }

    public function search(ProductId $id): ?Product
    {
        $model = EloquentProduct::find($id->value());

        if (null === $model) {
            return null;
        }

        return $this->transformModelToDomainEntity($model);
    }

    public function matching(Criteria $criteria): Products
    {
        $query = EloquentProduct::query();

        EloquentCriteriaConverter::apply($query, $criteria);

        return new Products(map(function (EloquentProduct $model) {
            return $this->transformModelToDomainEntity($model);
        }, $query->get()->all()));
    }

    public function matchingCount(Criteria $criteria): int
    {
        $query = EloquentProduct::query();

        EloquentCriteriaConverter::apply($query, $criteria);

        return $query->count('id');
    }

    private function transformModelToDomainEntity(EloquentProduct $model): Product
    {
        return Product::fromPrimitives((array) $model->getOriginal());
    }
}
