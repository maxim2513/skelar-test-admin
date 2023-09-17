<?php
declare(strict_types=1);

namespace App\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:255'],
            'price' => ['required', 'decimal:0,2'],
            'description' => ['required','string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
