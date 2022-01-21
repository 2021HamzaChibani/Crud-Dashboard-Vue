<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_name' => 'nullable',
            'due_date' => 'nullable',
            'customer_id' => 'nullable',
            'items.*.title' => 'required',
            'items.*.price' => 'required',
            'items.*.quantity' => 'required',

        ];
    }
}
