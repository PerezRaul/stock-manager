<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Infrastructure\Persistence;

use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\ProductStockMovements\ProductStockMovementId;
use Src\Shared\Infrastructure\Persistence\Eloquent\EloquentCriteriaConverter;
use Src\Shared\Infrastructure\Persistence\Eloquent\EloquentRepository;
use Src\ProductStockMovements\Domain\ProductStockMovement;
use Src\ProductStockMovements\Domain\ProductStockMovementRepository;
use Src\ProductStockMovements\Domain\ProductStockMovements;
use Src\ProductStockMovements\Infrastructure\Persistence\Eloquent\ProductStockMovement as EloquentProductStockMovement;

use function Lambdish\Phunctional\map;

final class EloquentProductStockMovementRepository extends EloquentRepository implements ProductStockMovementRepository
{
    public function save(ProductStockMovement $productStockMovement): void
    {
        if (!$productStockMovement->hasChanges()) {
            return;
        }

        EloquentProductStockMovement::updateOrCreate([
            'id' => $productStockMovement->id()->value(),
        ], $productStockMovement->toPrimitives());
    }

    public function search(ProductStockMovementId $id): ?ProductStockMovement
    {
        $model = EloquentProductStockMovement::find($id->value());

        if (null === $model) {
            return null;
        }

        return $this->transformModelToDomainEntity($model);
    }

    public function matching(Criteria $criteria): ProductStockMovements
    {
        $query = EloquentProductStockMovement::query();

        EloquentCriteriaConverter::apply($query, $criteria);

        return new ProductStockMovements(map(function (EloquentProductStockMovement $model) {
            return $this->transformModelToDomainEntity($model);
        }, $query->get()->all()));
    }

    public function matchingCount(Criteria $criteria): int
    {
        $query = EloquentProductStockMovement::query();

        EloquentCriteriaConverter::apply($query, $criteria);

        return $query->count('id');
    }

    public function delete(ProductStockMovementId $id): void
    {
        EloquentProductStockMovement::query()->where('id', $id->value())->delete();
    }

    private function transformModelToDomainEntity(EloquentProductStockMovement $model): ProductStockMovement
    {
        return ProductStockMovement::fromPrimitives((array) $model->getOriginal());
    }
}
