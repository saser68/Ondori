@extends('layouts.app')

@section('title', 'Editar Usuario - Admin')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Editar Usuario</h1>
            <p class="text-gray-600 mt-2">Modifica la información del usuario seleccionado</p>
        </div>
        
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                <p class="text-red-600">{{ session('error') }}</p>
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.users.update', $usuario->ID_USUario) }}">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="nombre" value="{{ $usuario->Nombre }}" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                    <input type="text" name="apellido" value="{{ $usuario->Apellido }}" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ $usuario->email }}" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                    <input type="tel" name="telefono" value="{{ $usuario->Telefono }}" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="600000000">
                </div>
            </div>
            
            <!-- Información del sistema -->
            <div class="bg-gray-50 p-4 rounded-md mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Información del Sistema</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">ID de Usuario:</span>
                        <span class="font-medium">{{ $usuario->ID_USUario }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Tipo de Usuario:</span>
                        <span class="font-medium">
                            @if($usuario->email === 'admin@ondori.com')
                                Administrador
                            @else
                                Cliente
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex gap-4">
                <button type="submit" class="bg-black text-white px-6 py-3 rounded-md hover:bg-gray-800 transition">
                    Actualizar Usuario
                </button>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition">
                    Cancelar
                </a>
                @if($usuario->email !== 'admin@ondori.com')
                    <button type="button" onclick="confirmDelete({{ $usuario->ID_USUario }})" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition">
                        Eliminar Usuario
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
function confirmDelete(userId) {
    if (confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/users/' + userId + '/delete';
        
        // Añadir CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                        document.querySelector('input[name="_token"]')?.value;
        
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
        }
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
