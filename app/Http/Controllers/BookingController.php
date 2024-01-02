<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Owner\KatalogMakeup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $user = Auth::user();

            if ($user) {
                $customer = Customer::where('user_id', $user->id)->first();

                if ($customer) {
                    $makeup = KatalogMakeup::find($request->makeup);

                    if ($makeup) {
                        $tanggal_booking = Carbon::createFromFormat('Y-m-d', $request->date)->format('Y-m-d');

                        $booking = Booking::create([
                            'id_booking' => "BOOK-" . date("YmdHis"),
                            'id_customer' => $customer->id_customer,
                            'id_order' => "ORDER-" . date("YmdHis"),
                            'user_id_mua' => $makeup->user_id,
                            'name' => $request->name_event,
                            'makeup' => $request->makeup,
                            'type_makeup' => $request->type_makeup,
                            'tanggal_booking' => $tanggal_booking,
                            'waktu_booking' => $request->waktu,
                            'status' => '0',
                        ]);

                        if ($booking) {
                            Alert::success('Success', 'Booking successfully created!')->autoClose(3000)->timerProgressBar();
                            return redirect()->back();
                        } else {
                            Alert::error('Error', 'Failed to create booking!')->autoClose(3000)->timerProgressBar();
                            return redirect()->back();
                        }
                    } else {
                        Alert::error('Error', 'Makeup not found!')->autoClose(3000)->timerProgressBar();
                        return redirect()->back();
                    }
                } else {
                    Alert::error('Error', 'Customer not found!')->autoClose(3000)->timerProgressBar();
                    return redirect()->back();
                }
            } else {
                Alert::error('Error', 'User not authenticated!')->autoClose(3000)->timerProgressBar();
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'An unexpected error occurred!')->autoClose(3000)->timerProgressBar();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
