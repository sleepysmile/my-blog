<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DefaultController extends \Illuminate\Routing\Controller
{
    public function index() {
        return view('admin.default.index');
    }
}
