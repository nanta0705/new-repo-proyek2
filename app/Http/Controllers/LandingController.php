<?php

namespace App\Http\Controllers;

use App\Models\Admin\Content;
use App\Models\Owner\DetailMakeup;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $content = Content::where('active', 1)->get();
        return view('v_landing', compact('content'));
    }

    // public function getDataTypeLanding(Request $request)
    // {
    //     $id = $request->makeup;
    //     $dataTypeLanding = DetailMakeup::with('getType')->where('id_makeup', $id)->get();
    //     foreach ($dataTypeLanding as $data) {
    //         echo "<option value='" . $data->getType['id'] . "'>" . $data->getType['name'] . "</option>";
    //     }
    // }
}
