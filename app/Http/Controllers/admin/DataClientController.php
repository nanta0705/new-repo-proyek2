<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DataClientController extends Controller
{
    public function index()
    {
        $user = Customer::join('users', 'customer.user_id', '=', 'users.id')
            ->where('users.role_id', 3)
            ->select('customer.*')
            ->get();
        return view('admin.akun_client.index', compact('user'));
    }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->nama,
                'username' => str::slug($request->nama),
                'email' => $request->email,
                'password' => bcrypt('password'),
                'no_tlp' => $request->no_telepon,
                'alamat' => $request->alamat,
                'role_id' => '3',
            ]);

            Customer::create([
                "id_customer" => "CUST-" . date("YmdHis"),
                'user_id' => $user->id,
                'pekerjaan' => $request->pekerjaan,
            ]);
            Alert::success('yeay data berhasil');
            return back()->with('success');
        } catch (\Exception $e) {
            Alert::error('gagal update' . $e->getMessage());
            return back()->with('error');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            User::where("id", $id)->update([
                'name' => $request->nama,
                'alamat' => $request->alamat,
                'no_tlp' => $request->no_telepon,
                'email' => $request->email,
            ]);
            Alert::success('yeay data berhasil');
            return back()->with('success');
        } catch (\Exception $e) {
            Alert::error('gagal update' . $e->getMessage());
            return back()->with('error');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::where('id', $id)->first();
            $user->delete();
            Alert::success('data berhasil dihapus');
            return back()->with('success');
        } catch (\Exception $e) {
            Alert::error('yah gagal hapus' . $e->getMessage());
            return back()->with('error' . $e->getMessage());
        }
    }
}
