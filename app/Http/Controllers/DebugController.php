<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebugController extends Controller
{
    public function index(Request $request) {
        return view('public.debug.index', [
            dd($request->route()),
        ]);
    }
}
