<?php

use Src\Products\Domain\ProductRepository;
use Src\Products\Infrastructure\Persistence\EloquentProductRepository;
use Src\ProductStockMovements\Domain\ProductStockMovementRepository;
use Src\ProductStockMovements\Infrastructure\Persistence\EloquentProductStockMovementRepository;

return [
    'binds'      => [
        //REPOSITORIES
        ProductRepository::class              => EloquentProductRepository::class,
        ProductStockMovementRepository::class => EloquentProductStockMovementRepository::class,
    ],
    'singletons' => [],
];
