<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner\TypeMakeup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TypeMakeupController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $type = TypeMakeup::where('user_id', $user)->get();
        return view('owner.type_makeup.index', compact('type'));
    }

    public function store(Request $request)
    {
        try {

            TypeMakeup::create([
                'name' => $request->name,
                'user_id' => Auth::user()->id,

            ]);
            Alert::success('Data Type Makeup Berhasil Ditambah');
            return back();
        } catch (\Exception $e) {
            Alert::error('Data Type Makeup Gagal Disimpan!' . $e->getmessage());
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $type = TypeMakeup::findOrFail($id);
            $type->name = $request->name;

            $type->save();

            // Add success alert
            Alert::success('Data Berhasil Diubah');
            return back();
        } catch (\Exception $e) {
            // Add error alert
            Alert::error('Data Gagal Diubah!');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $makeup = TypeMakeup::where('id', $id)->first();
            $makeup->delete();

            Alert::success('Data Berhasil Dihapus');
            return back();
        } catch (\Exception $e) {
            Alert::error('Data Gagal Dihapus');
            return back();
        }
    }
}
