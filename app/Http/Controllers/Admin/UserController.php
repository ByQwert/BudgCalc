<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('public.admin.users.index', [
            'users' => $users,
            'userCounter' => 0
        ]);
    }
}