<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Products\Application\Put\PutProductCommand;
use Src\Shared\Domain\Bus\Command\CommandBus;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = require __DIR__ . '/products/products.php';

        foreach ($products as $product) {
            app(CommandBus::class)->dispatch(new PutProductCommand(
                $product['id'],
                $product['name'],
            ));
        }
    }
}
