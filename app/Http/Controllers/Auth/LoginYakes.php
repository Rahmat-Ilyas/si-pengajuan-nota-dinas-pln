<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginYakes extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:yakes')->except('logout');
    }

    public function showLoginForm()
    {
        return view('yakes.login');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:3'
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('yakes')->attempt($credential, $request->filled('remember'))) {
            return redirect()->intended(route('yakes.home'));
        }

        //return redirect()->back()->withInput($request->only('username', 'password'));

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('yakes')->logout();

        $request->session()->invalidate();

        return redirect('/yakes');
    }
}
