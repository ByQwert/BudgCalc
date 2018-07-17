<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
//    public function __construct() {
//        $this->middleware(AdminMiddleware::class);
//    }

    public function index() {
        return view('public.admin.index', [

        ]);
    }
}
