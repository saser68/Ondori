@extends('layouts.app')

@section('title', 'Registrarse - Ondori')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-white px-4 sm:px-6 lg:px-8 pt-4">
    <!-- Logo Ondori Grande -->
    <div class="text-center mb-2">
        <img src="{{ asset('img/O.png') }}" alt="Ondori" class="mx-auto h-40 w-auto mb-4" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
        <div class="mx-auto h-40 w-40 bg-black rounded-lg flex items-center justify-center text-white font-bold text-5xl mb-4" style="display:none;">
            O
        </div>
    </div>

    <!-- Formulario Centrado -->
    <div class="w-full max-w-sm">
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                <div class="text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form class="space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input 
                        id="nombre" 
                        name="nombre" 
                        type="text" 
                        autocomplete="name" 
                        required
                        value="{{ old('nombre') }}"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="Tu nombre"
                    >
                    @if ($errors->has('nombre'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input 
                        id="apellido" 
                        name="apellido" 
                        type="text" 
                        autocomplete="family-name" 
                        required
                        value="{{ old('apellido') }}"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="Tu apellido"
                    >
                    @if ($errors->has('apellido'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('apellido') }}
                        </div>
                    @endif
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required
                        value="{{ old('email') }}"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="tu@email.com"
                    >
                    @if ($errors->has('email'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input 
                        id="telefono" 
                        name="telefono" 
                        type="tel" 
                        autocomplete="tel" 
                        value="{{ old('telefono') }}"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="600 000 000"
                    >
                    @if ($errors->has('telefono'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('telefono') }}
                        </div>
                    @endif
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña (mínimo 6 caracteres)</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        autocomplete="new-password" 
                        required
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="•••••"
                    >
                    @if ($errors->has('password'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        autocomplete="new-password" 
                        required
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="••••••"
                    >
                    @if ($errors->has('password_confirmation'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition duration-200"
                >
                    Crear Cuenta
                </button>
            </div>
        </form>

        <!-- Links debajo del formulario -->
        <div class="mt-6 text-center space-y-2">
            <p class="text-sm text-gray-600">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="font-medium text-black hover:text-gray-700">
                    inicia sesión
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
