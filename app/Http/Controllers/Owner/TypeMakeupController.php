<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner\TypeMakeup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeMakeupController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $type = TypeMakeup::where('user_id', $user);
        return view('owner.type_makeup.index', compact('type'));
    }
}
