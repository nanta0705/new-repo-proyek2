<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index()
    {
        return view('regis.register');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => str::slug($request->name),
                'email' => $request->email,
                'password' => $request->password,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'role_id' => '3',
            ]);
            Customer::create([
                "id_customer" => "CUST-" . date("YmdHis"),
                'user_id' => $user->id,
                'pekerjaan' => $request->pekerjaan,
            ]);
            Alert::success('Register Berhasil, Silahkan Login');
            return redirect('/login');
        } catch (\Exception $e) {
            Alert::error('gagal update' . $e->getMessage());
            return back();
        }
    }
}
