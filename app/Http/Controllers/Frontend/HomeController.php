<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {;
        return view('frontend.home.index');
    }

    public function tag(Request $request)
    {

    }
}
