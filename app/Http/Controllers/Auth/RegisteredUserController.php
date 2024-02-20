<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $profile = Setting::all();
        return view('backend.auth.register', compact('profile'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->confirmed);
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:25'],
            'username' => ['required', 'string', 'min:5', 'max:25'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!$validated) {
            return redirect('register')->with('info', 'Mungkin ada input kamu yang salah');
        } else {

            $user = User::create([
                'name' => $request->name,
                'user_name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Session::flush();
            Auth::logoutOtherDevices($request->password);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')
            ->with('success','User Registration Success');
        }
    }
}
