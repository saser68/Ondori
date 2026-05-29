<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
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
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:Usuarios,Email'],
            'telefono' => ['nullable', 'string', 'max:20', 'unique:Usuarios,Telefono'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*\d).+$/'],
        ], [
            'password.regex' => 'La contraseña debe tener al menos 6 caracteres y contener al menos un número.',
        ]);

        $usuario = Usuario::create([
            'Nombre' => $request->nombre,
            'Apellido' => $request->apellido,
            'Email' => $request->email,
            'Telefono' => $request->telefono,
            'Password' => $request->password, // El modelo lo hashea automáticamente
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect('/')->with('success', '¡Cuenta creada correctamente! Ya puedes iniciar sesión.');
    }
}
