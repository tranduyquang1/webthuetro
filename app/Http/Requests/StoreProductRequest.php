<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Product,name',
                'min:2',
                'max:50',
            ],
            'unit' => [
                'bail',
                'required',
                'string',
                'min:2',
                'max:10',
            ],
            'quantity' => [
                'bail',
                'required',
                'numeric'
            ],
            'price' => [
                'bail',
                'required',
                'numeric',
            ],
            'desc' => [
                'bail',
                'required',
            ],
            'avatar' => [
                'bail',
                'required',
                'image',
            ],
            'pin' => [
                'bail',
                'required',
            ],
            'weight' => [
                'bail',
                'required'
            ],
            'ram_id' => [
                'bail',
                'required',
            ],
            'gpu_id' => [
                'bail',
                'required',
            ],
            'cpu_id' => [
                'bail',
                'required',
            ],
            'category_id' => [
                'bail',
                'required',
            ],
            'brand_id' => [
                'bail',
                'required',
            ],
            'supplier_id' => [
                'bail',
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute b???t bu???c ph???i ??i???n',
            'string' => ':attribute ph???i l?? k?? t???',
            'min' => ':attribute ??t nh???t ph???i c?? :min k?? t???',
            'max' => ':attribute kh??ng ???????c nhi???u h??n :max k?? t???',
            'email' => ':attribute ph???i h???p l???',
            'unique' => ':attribute ???? t???n t???i'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'T??n s???n ph???m',
            'unit' => '????n v???',
            'quantity' => 'S??? l?????ng',
            'price' => 'Gi?? s???n ph???m',
            'desc' => 'M?? t???',
            'avatar' => '???nh ?????i di???n',
            'pin' => 'Pin',
            'weight' => 'Tr???ng l?????ng',
            'ram_id' => 'Ram',
            'cpu_id' => 'CPU',
            'gpu_id' => 'GPU',
            'category_id' => 'Danh m???c',
            'brand_id' => 'Th????ng hi???u',
            'supplier_id' => 'Nh?? cung c???p',
        ];
    }
}
