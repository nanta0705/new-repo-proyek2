<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner\DetailMakeup;
use App\Models\Owner\KatalogMakeup;
use App\Models\Owner\TypeMakeup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class KatalogMakeupController extends Controller
{
    public function index()
    {
        $type = TypeMakeup::all();
        $user = Auth::user()->id;
        $katalog_makeup = KatalogMakeup::where('user_id', $user)->get();
        return view('owner.katalog_makeup.index', compact('katalog_makeup', 'type'));
    }


    public function store(Request $request)
    {
        try {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $ImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('katalog_makeup_image'), $ImageName);

            $makeup = KatalogMakeup::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => 'katalog_makeup_image/' . $ImageName,
                'user_id' => Auth::user()->id,

            ]);

            $makeupId = $makeup->id;

            $selectedTypeMakeup = $request->input('type_makeup');

            foreach ($selectedTypeMakeup as $typeMakeupId) {
                DetailMakeup::create([
                    'id_makeup' => $makeupId,
                    'id_type_makeup' => $typeMakeupId,
                ]);
            }


            Alert::success('Data Makeup Berhasil Ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Data Makeup Gagal Disimpan!' . $e->getmessage());
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Use 'sometimes' to make image optional
            ]);

            $makeup = KatalogMakeup::findOrFail($id);
            $makeup->name = $request->name;
            $makeup->description = $request->description;
            $makeup->price = $request->price;

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if (File::exists(public_path($makeup->image))) {
                    File::delete(public_path($makeup->image));
                }

                // Upload new image
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('katalog_makeup_image'), $imageName);
                $makeup->image = 'katalog_makeup_image/' . $imageName;
            }

            $makeup->save();

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
            $makeup = KatalogMakeup::where('id', $id)->first();
            $makeup->delete();

            Alert::success('Data Berhasil Dihapus');
            return back();
        } catch (\Exception $e) {
            Alert::error('Data Gagal Dihapus');
            return back();
        }
    }
}
