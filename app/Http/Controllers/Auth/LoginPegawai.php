<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginPegawai extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:pegawai')->except('logout');
    }

    public function showLoginForm()
    {
        return view('pegawai.login');
    }

    public function username()
    {
        return 'nip';
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required|min:3'
        ]);

        $credential = [
            'nip' => $request->nip,
            'password' => $request->password,
        ];

        if (Auth::guard('pegawai')->attempt($credential, $request->filled('remember'))) {
            return redirect()->intended(route('pegawai.home'));
        }

        //return redirect()->back()->withInput($request->only('nip', 'password'));

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'nip' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('pegawai')->logout();

        $request->session()->invalidate();

        return redirect('/pegawai');
    }
}
