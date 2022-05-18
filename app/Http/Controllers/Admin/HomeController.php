<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;

class HomeController
{
    public function index()
    {
        $bookings=Booking::all();
        $approved=Booking::confirmed();
        $pending=Booking::pending();
        $cancelled=Booking::cancelled();
        return view('home',compact('bookings','approved','pending','cancelled'));
    }
}
