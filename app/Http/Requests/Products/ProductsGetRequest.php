<?php

declare(strict_types=1);

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

final class ProductsGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search'   => 'sometimes|string',
            'per_page' => 'sometimes|integer|min:5|max:500',
            'page'     => 'sometimes|integer',
        ];
    }
}
