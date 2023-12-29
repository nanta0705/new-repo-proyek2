<?php

namespace App\Http\Controllers;

use App\Models\Admin\Content;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $content = Content::where('active', 1)->get();
        return view('v_landing', compact('content'));
    }
}
