<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class PaymentController extends Controller
{


    public function initialize(StoreBookingRequest $request)
    {
        $booking = Booking::create($request->all());
        $reference = Flutterwave::generateReference();
        $data = [
            'amount' => 100,
            'email' => $booking->email,
            'tx_ref' => $reference,
            'currency' => 'RWF',
            'country' => 'RW',
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => $booking->email,
                'phone_number' => $booking->phone_number,
                'name' => $booking->name,
            ],
            "customizations" => [
                "title" => 'Payment of consultation fees on ' . config('app.name'),
                "description" => "These are the fees that are payed before starting the meeting of the service you have requested."
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


       if ($payment['status'] !== 'success') {
            // notify something went wrong
            return redirect()->route('failed');
        }

        return redirect($payment['data']['link']);
    }

    public function callback()
    {
        $status = request()->status;
        if ($status == 'success') {
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $infos = Flutterwave::verifyTransaction($transactionID);
            if ($infos['status'] == 'success') {
                return redirect()->route('success');
            } else {
                return redirect()->route('failed');
            }
        } elseif ($status == 'cancelled') {
            return redirect()->route('cancelled');
        }
        return redirect()->route('success');
    }


}
