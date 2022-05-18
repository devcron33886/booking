<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $services=Service::all();
        $staff = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('welcome',compact('services','staff'));
    }

}
