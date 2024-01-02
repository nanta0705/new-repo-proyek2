<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Owner\KatalogMakeup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientBookingController extends Controller
{
    public function index()
    {
        $booking = Booking::join('customer', 'booking.id_customer', '=', 'customer.id_customer')
            ->where('customer.user_id', Auth::user()->id)
            ->get();
        $makeup = KatalogMakeup::select('id', 'name')->get();

        return view('client.pages.client_booking', compact('booking', 'makeup'));
    }
}
