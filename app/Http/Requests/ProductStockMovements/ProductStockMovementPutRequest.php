<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductStockMovements;

use App\Http\Requests\FormRequest;

final class ProductStockMovementPutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|string',
            'type'       => 'required|string',
            'amount'     => 'required|integer',
        ];
    }
}
