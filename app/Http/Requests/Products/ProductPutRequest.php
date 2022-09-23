<?php

declare(strict_types=1);

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

final class ProductPutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
