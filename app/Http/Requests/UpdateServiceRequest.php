<?php

namespace App\Http\Requests;

use App\Models\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_edit');
    }

    public function rules()
    {
        return [
            'service_name' => [
                'string',
                'min:10',
                'max:255',
                'required',
                'unique:services,service_name,' . request()->route('service')->id,
            ],
            'duration' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'service_description' => [
                'required',
            ],
        ];
    }
}
