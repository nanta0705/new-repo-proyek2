<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Content;
use App\Models\Owner\KatalogMakeup;
use App\Models\User;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', 2)->get();
        return view('admin.content.index', compact('user'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $name = $user->name;
        $content = Content::all();
        $makeup = KatalogMakeup::where('user_id', $id)->get();
        return view('admin.content.view', compact('makeup', 'name', 'content'));
    }

    public function changeStatus(Request $request)
    {
        $isChecked = $request->input('isChecked');
        $productId = $request->input('productId');

        $produk = Content::find($productId);
        if ($produk) {
            $produk->active = $isChecked ? 1 : 0;
            $produk->save();
        }
        return response()->json(['status' => 'success']);
    }
}
