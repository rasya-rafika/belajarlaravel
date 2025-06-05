<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Cek apakah email adalah admin@gmail.com
        if ($user->email === 'admin@gmail.com') {
            // Berikan role admin jika email adalah admin@gmail.com
            $user->assignRole('admin');
        } else {
            // Berikan role user untuk semua email lain
            $user->assignRole('user');
        }


        // Beri permission tambah-artikel juga (opsional, karena role user sudah punya)
        $user->givePermissionTo('tambah-artikel');
        $user->givePermissionTo('tambah-dokter');
        $user->givePermissionTo('tambah-adopsi');
        $user->givePermissionTo('tambah-kontak');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}