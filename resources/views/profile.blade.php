@extends('layouts.app')

@section('title', 'Mi Perfil - Ondori')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Mi Perfil</h1>
        
        <!-- Avatar y Nombre -->
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center text-white font-bold text-3xl mx-auto mb-3">
                {{ substr(auth()->user()->Nombre, 0, 1) }}
            </div>
            <h2 class="text-xl font-semibold">{{ auth()->user()->Nombre }} {{ auth()->user()->Apellido }}</h2>
            <p class="text-gray-600">{{ auth()->user()->Email }}</p>
        </div>
        
        <!-- Información Básica -->
        <div class="space-y-4 mb-6">
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Nombre</span>
                <span class="font-medium">{{ auth()->user()->Nombre }}</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Apellido</span>
                <span class="font-medium">{{ auth()->user()->Apellido }}</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Email</span>
                <span class="font-medium">{{ auth()->user()->Email }}</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Teléfono</span>
                <span class="font-medium">{{ auth()->user()->Telefono ?? 'No especificado' }}</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-gray-600">Tipo de Cuenta</span>
                <span class="font-medium">
                    @if(auth()->user()->email === 'admin@ondori.com')
                        Administrador
                    @else
                        Cliente
                    @endif
                </span>
            </div>
        </div>

        <div class="mt-8 bg-gray-50 p-6 rounded-lg border">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Cambiar contraseña</h2>

            @if(session('status') === 'password-updated')
                <div class="mb-4 rounded-lg bg-green-100 border border-green-200 p-3 text-green-800">
                    Tu contraseña se actualizó correctamente.
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña actual</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" required>
                    @if ($errors->updatePassword->has('current_password'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" required>
                    @if ($errors->updatePassword->has('password'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar nueva contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" required>
                </div>

                <button type="submit" class="w-full bg-black text-white px-4 py-2 rounded hover:bg-gray-900 transition">
                    Actualizar contraseña
                </button>
            </form>
        </div>

        <!-- Botones -->
        <div class="flex gap-3 mt-6">
            <a href="/" class="flex-1 bg-black text-white px-4 py-2 rounded text-center hover:bg-gray-800 transition">
                Volver a la Tienda
            </a>
            @if(auth()->user()->email === 'admin@ondori.com')
                <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-red-600 text-white px-4 py-2 rounded text-center hover:bg-red-700 transition">
                    Panel Admin
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
