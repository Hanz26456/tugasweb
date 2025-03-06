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
        // Menambahkan validasi untuk no telepon, gaji pokok, dan pinjaman
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'no_telepon' => ['required', 'regex:/^\+?[0-9]{10,15}$/'], // Validasi nomor telepon
            'gajipokok' => ['required', 'numeric', 'min:0'], // Validasi gaji pokok
            'pinjaman' => ['required', 'numeric', 'min:0'], // Validasi pinjaman
            'password' => ['required', 'confirmed', 'min:8', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[\W_]/'], // Validasi password
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        // Membuat pengguna baru dan menyimpan data tambahan seperti no telepon, gaji pokok, dan pinjaman
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon, // Menyimpan nomor telepon
            'gajipokok' => $request->gajipokok, // Menyimpan gaji pokok
            'pinjaman' => $request->pinjaman, // Menyimpan pinjaman
            'password' => Hash::make($request->password),
        ]);

        // Menyebarkan event "Registered" setelah berhasil registrasi
        event(new Registered($user));

        // Melakukan login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard atau halaman yang sesuai setelah registrasi berhasil
        return redirect(route('dashboard', absolute: false));
    }
}
