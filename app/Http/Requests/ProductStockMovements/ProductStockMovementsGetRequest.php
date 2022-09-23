<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductStockMovements;

use App\Http\Requests\FormRequest;

final class ProductStockMovementsGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|string',
            'search'     => 'sometimes|string',
            'per_page'   => 'sometimes|integer|min:5|max:500',
            'page'       => 'sometimes|integer',
        ];
    }
}
