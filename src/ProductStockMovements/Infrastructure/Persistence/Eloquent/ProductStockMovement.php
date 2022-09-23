<?php

namespace Src\ProductStockMovements\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class ProductStockMovement extends Model
{
    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_stock_movements';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];
}
