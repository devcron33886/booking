<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function failed()
    {
        return view('payments.failed');
    }

    public function cancelled()
    {
        return view('payments.cancelled');
    }

    public function success()
    {
        return view('payments.success');
    }
}
