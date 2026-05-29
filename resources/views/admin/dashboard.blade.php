@extends('layouts.app')

@section('title', 'Admin - Panel de Administración')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Panel de Administración</h1>
        <p class="mt-2 text-gray-600">Gestiona los productos y usuarios de tu tienda Ondori</p>
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

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <p class="font-semibold text-red-700 mb-2">No se pudo guardar el producto:</p>
            <ul class="list-disc pl-5 text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Tabs de navegación -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button onclick="showTab('products')" id="products-tab" class="tab-button py-4 px-6 text-sm font-medium text-black border-b-2 border-black">
                    Productos
                </button>
                <button onclick="showTab('users')" id="users-tab" class="tab-button py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                    Usuarios
                </button>
            </nav>
        </div>
    </div>
    
    <!-- Tab de Productos -->
    <div id="products-content" class="tab-content">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-6">Añadir Nuevo Producto</h2>
            
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Categoría -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <select name="category" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="ofertas">Ofertas</option>
                    </select>
                </div>
                
                <!-- Nombre -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Producto</label>
                    <input type="text" name="nombre" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="Ej: Sudadera Negra Elegante" required>
                </div>
                
                <!-- Descripción -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea name="descripcion" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" rows="3" placeholder="Describe el producto..." required></textarea>
                </div>
                
                <!-- Campos específicos (solo para hombre y mujer) -->
                <div id="specificFields" class="hidden">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Ropa</label>
                            <input type="text" name="tipoRopa" data-specific-field class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="Ej: Sudadera, Camiseta, Vestido">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                            <input type="text" name="color" data-specific-field class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="Ej: Negro, Blanco, Azul">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Talla</label>
                        <input type="text" name="talla" data-specific-field class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="Ej: S, M, L, XL">
                    </div>
                </div>
                
                <!-- Precio -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Precio (€)</label>
                    <input type="number" name="precio" step="0.01" min="0" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="29.99" required>
                </div>
                
                <!-- Stock -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stock (unidades)</label>
                    <input type="number" name="stock" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" placeholder="0" min="0">
                </div>
                
                <!-- Imagen -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto del Producto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black" required>
                    <p class="text-sm text-gray-500 mt-1">Formatos: JPEG, PNG, JPG. Máximo 2MB</p>
                </div>
                
                <!-- Botones -->
                <div class="flex gap-4">
                    <button type="submit" class="bg-black text-white px-6 py-3 rounded-md hover:bg-gray-800 transition">
                        Añadir Producto
                    </button>
                    <a href="/" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition">
                        Volver a la Tienda
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tab de Usuarios -->
    <div id="users-content" class="tab-content hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-6">Gestión de Usuarios</h2>
            
            <!-- Lista de usuarios -->
            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4">Usuarios Registrados</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->ID_USUario }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->Nombre }} {{ $usuario->Apellido }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->Telefono ?? 'No especificado' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editUser({{ $usuario->ID_USUario }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</button>
                                    <form action="/admin/users/{{ $usuario->ID_USUario }}/delete" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    
    <!-- Estadísticas rápidas -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-2xl font-bold text-black">Hombre</div>
            <div class="text-lg font-semibold">Productos</div>
            <div class="text-sm text-gray-600">Disponibles</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-2xl font-bold text-black">Mujer</div>
            <div class="text-lg font-semibold">Productos</div>
            <div class="text-sm text-gray-600">Disponibles</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-2xl font-bold text-black">Ofertas</div>
            <div class="text-lg font-semibold">Productos</div>
            <div class="text-sm text-gray-600">En oferta</div>
        </div>
    </div>
</div>

<style>
.tab-button {
    transition: all 0.3s ease;
}

.tab-button:hover {
    border-color: #374151;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}
</style>

<script>
function showTab(tabName) {
    // Ocultar todos los contenidos
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
        content.classList.add('hidden');
    });
    
    // Resetear todos los botones
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('text-black', 'border-black');
        button.classList.add('text-gray-500', 'border-transparent');
    });
    
    // Mostrar el contenido seleccionado
    const selectedContent = document.getElementById(tabName + '-content');
    selectedContent.classList.remove('hidden');
    selectedContent.classList.add('active');
    
    // Activar el botón seleccionado
    const selectedButton = document.getElementById(tabName + '-tab');
    selectedButton.classList.remove('text-gray-500', 'border-transparent');
    selectedButton.classList.add('text-black', 'border-black');
}

// Mostrar/ocultar campos según categoría
document.querySelector('select[name="category"]').addEventListener('change', function() {
    const specificFields = document.getElementById('specificFields');
    const specificInputs = document.querySelectorAll('[data-specific-field]');
    
    if (this.value === 'ofertas') {
        specificFields.classList.add('hidden');
        specificInputs.forEach(input => input.disabled = true);
    } else if (this.value === 'hombre' || this.value === 'mujer') {
        specificFields.classList.remove('hidden');
        specificInputs.forEach(input => input.disabled = false);
    } else {
        specificFields.classList.add('hidden');
        specificInputs.forEach(input => input.disabled = true);
    }
});

// Funciones para usuarios
function editUser(userId) {
    // Redirigir a página de edición con el ID del usuario
    window.location.href = '/admin/users/' + userId + '/edit';
}

function deleteUser(userId) {
    if (confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
            // Enviar formulario de eliminación con spoofing de método DELETE
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/users/' + userId + '/delete';
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                            document.querySelector('input[name="_token"]')?.value;
            
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
            }

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
        form.submit();
    }
}

// Inicializar con la pestaña de productos activa
document.addEventListener('DOMContentLoaded', function() {
    showTab('products');
    document.querySelector('select[name="category"]').dispatchEvent(new Event('change'));
});
</script>
@endsection
