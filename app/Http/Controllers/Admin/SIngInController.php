<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class SIngInController extends Controller
{
    public function index() {
        return view('admin/sing-in/index');
    }
}
