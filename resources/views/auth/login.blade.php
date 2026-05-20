@extends('layouts.app')

@section('title', 'Iniciar Sesión - Ondori')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8 pt-4">
    <!-- Logo Ondori Grande -->
    <div class="text-center mb-2">
        <img src="{{ asset('img/O.png') }}" alt="Ondori" class="mx-auto h-40 w-auto mb-4" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
        <div class="mx-auto h-40 w-40 bg-black rounded-lg flex items-center justify-center text-white font-bold text-5xl mb-4" style="display:none;">
            O
        </div>
    </div>

    <!-- Formulario Centrado -->
    <div class="w-full max-w-sm">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        <form class="space-y-6" method="POST" action="{{ route('login') }}">

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required 
                        value="{{ old('email') }}"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" style="background-color: white !important;" 
                        placeholder="tu@email.com"
                    >
                    @if ($errors->has('email'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        autocomplete="current-password" 
                        required 
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 bg-white placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-black focus:border-black sm:text-sm" style="background-color: white !important;" 
                        placeholder="••••••••"
                    >
                    @if ($errors->has('password'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        Recordarme
                    </label>
                </div>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition duration-200"
                >
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</div>
@endsection