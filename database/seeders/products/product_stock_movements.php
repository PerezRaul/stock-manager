<?php

use Src\ProductStockMovements\Domain\ProductStockMovementType;
use Src\Shared\Domain\ValueObject\Uuid;

return [
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '742c25ba-4859-435e-ba24-69a2f8aa03e4',
        'type'       => ProductStockMovementType::ADD_STOCK,
        'amount'     => 40,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '742c25ba-4859-435e-ba24-69a2f8aa03e4',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 20,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '742c25ba-4859-435e-ba24-69a2f8aa03e4',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 10,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '742c25ba-4859-435e-ba24-69a2f8aa03e4',
        'type'       => ProductStockMovementType::SALE_CANCELED,
        'amount'     => 10,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '7808ddc2-8df0-40e7-88f7-86db20a203c0',
        'type'       => ProductStockMovementType::ADD_STOCK,
        'amount'     => 20,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '7808ddc2-8df0-40e7-88f7-86db20a203c0',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 5,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::ADD_STOCK,
        'amount'     => 50,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 20,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 10,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::SALE_CANCELED,
        'amount'     => 10,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 25,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::SALE,
        'amount'     => 5,
    ],
    [
        'id'         => Uuid::random()->value(),
        'product_id' => '87135271-3801-45af-8c56-33132aef7155',
        'type'       => ProductStockMovementType::SALE_CANCELED,
        'amount'     => 5,
    ],
];
