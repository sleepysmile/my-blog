<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Singletons\Settings;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index');
    }

    public function tag(Request $request)
    {

    }
}
