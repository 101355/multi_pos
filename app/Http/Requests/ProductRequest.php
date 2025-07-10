<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'warehouse_id'       => 'required|exists:warehouses,id',
            'item_name'          => 'required|string|max:255',
            'barcode'            => 'nullable|string|max:255',
            'description'        => 'nullable|string',
            'expired_date'       => 'nullable|date',
            'sub_category'       => 'nullable|string|max:255',
            'category'           => 'required|string|max:255',
            'item_type'          => 'nullable|string|max:255',
            'quantity'           => 'required|numeric|min:0',
            'alert_quantity'     => 'nullable|numeric|min:0',
            'unit1'              => 'nullable|string|max:50',
            'unit2'              => 'nullable|numeric|min:1',
            'unit3'              => 'nullable|string|max:50',
            'name1'              => 'nullable|string|max:255',
            'name2'              => 'nullable|string|max:255',
            'name3'              => 'nullable|string|max:255',
            'purchase_price1'    => 'nullable|numeric|min:0',
            'purchase_price2'    => 'nullable|numeric|min:0',
            'purchase_price3'    => 'nullable|numeric|min:0',
            'retail1'            => 'nullable|numeric|min:0',
            'retail2'            => 'nullable|numeric|min:0',
            'retail3'            => 'nullable|numeric|min:0',
            'wholesale1'         => 'nullable|numeric|min:0',
            'wholesale2'         => 'nullable|numeric|min:0',
            'wholesale3'         => 'nullable|numeric|min:0',
        ];
    }
}
