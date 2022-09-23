<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_movements', function (Blueprint $table) {
            $table->char('id', 36)->unique()->primary();
            $table->char('product_id', 36);
            $table->string('type')->index();
            $table->integer('amount');
            $table->timestamp('created_at', 6);
            $table->timestamp('updated_at', 6);

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stock_movements');
    }
};
