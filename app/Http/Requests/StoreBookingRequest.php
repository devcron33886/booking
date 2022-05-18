<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'service_id' => [
                'required',
                'integer',
            ],
            'meeting_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'name' => [
                'string',
                'min:4',
                'max:255',
                'required',
            ],
            'email' => [
                'required',
            ],
            'address' => [
                'string',
                'min:10',
                'max:255',
                'required',
            ],
            'phone_number' => [
                'string',
                'min:10',
                'max:16',
                'required',
            ],
            'privacy' => [
                'required',
            ],
        ];
    }
}
