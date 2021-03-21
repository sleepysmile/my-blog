<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingInController extends Controller
{
    public function index()
    {
        return view('admin.sing-in.index');
    }

    public function login(Request $request)
    {
        $signInData = $request->only('email', 'password');

        if (Auth::attempt($signInData)) {
            $request->session()->regenerate();

            return redirect()->intended('admin.default.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
