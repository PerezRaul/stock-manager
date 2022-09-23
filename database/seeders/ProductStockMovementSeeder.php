<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\ProductStockMovements\Application\Put\PutProductStockMovementCommand;
use Src\Shared\Domain\Bus\Command\CommandBus;

class ProductStockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $movements = require __DIR__ . '/products/product_stock_movements.php';

        foreach ($movements as $movement) {
            app(CommandBus::class)->dispatch(new PutProductStockMovementCommand(
                $movement['id'],
                $movement['product_id'],
                $movement['type'],
                $movement['amount'],
            ));
        }
    }
}
