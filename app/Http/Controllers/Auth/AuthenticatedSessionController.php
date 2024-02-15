<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('backend.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$validated){
            return redirect('login')->with('info', 'User And Password Wrong');
        }else{

            if(is_null($user)){
                return redirect('login')->with('error', 'Akun Tidak Terdaftar');
            }

            if (!Hash::check($request->password, $user->password, [])) {
                return redirect('login')->with('warning', 'Lupa Password ?');
            }

            if($user->is_active == 0 || $user->is_active == null){
                return redirect('login')->with('warning', 'Akun anda belum aktif hubungi PT. Evarindo');
            }

            DB::table('sessions')->whereUserId($user->id)->delete();
        }

        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
