<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => ['required', 'string', 'max:100'],
            'Apellido' => ['required', 'string', 'max:100'],
            'Email' => ['required', 'string', 'email', 'max:150', 'unique:Usuarios,Email'],
            'Telefono' => ['nullable', 'string', 'max:20', 'unique:Usuarios,Telefono'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*\d).+$/'],
        ], [
            'password.regex' => 'La contraseña debe tener al menos 6 caracteres y contener al menos un número.',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Crear el usuario en la base de datos (sin timestamps)
        $user = new User();
        $user->Nombre = $request->Nombre;
        $user->Apellido = $request->Apellido;
        $user->Email = $request->Email;
        $user->Telefono = $request->Telefono;
        $user->Password = Hash::make($request->password);
        $user->save();

        // Autenticar al usuario automáticamente después del registro
        auth()->login($user);

        // Enviar email de bienvenida
        try {
            Mail::to($user->getEmailAttribute())->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            // Si falla el email, continuamos con el registro
            \Log::error('Error enviando email de bienvenida: ' . $e->getMessage());
        }

        // Redirigir al dashboard o a donde quieras
        return redirect('/dashboard')->with('success', '¡Cuenta creada exitosamente! Revisa tu email para un regalo especial.');
    }
}
