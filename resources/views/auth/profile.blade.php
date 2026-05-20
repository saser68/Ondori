<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row gap-8">
        
        <aside class="w-full md:w-1/3">
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span class="text-2xl text-gray-400 font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                
                <hr class="my-6 border-gray-100">
                
                <nav class="space-y-2 text-left text-sm">
                    <a href="#" class="block text-blue-600 font-medium py-2 px-3 bg-blue-50 rounded-md">Información Personal</a>
                    <a href="#" class="block text-gray-600 hover:text-blue-600 py-2 px-3 rounded-md transition-colors">Seguridad y Contraseña</a>
                    <a href="#" class="block text-gray-600 hover:text-blue-600 py-2 px-3 rounded-md transition-colors">Notificaciones</a>
                </nav>
            </div>
        </aside>

        <main class="flex-1 bg-white border border-gray-200 rounded-lg p-6 md:p-8">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Detalles del Perfil</h3>
            
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500 cursor-not-allowed" disabled>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Biografía</label>
                    <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Cuéntanos algo sobre ti..."></textarea>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-[#1b1b18] text-white px-6 py-2 rounded-md hover:bg-black transition-colors text-sm font-medium">
                        Editar
                    </button>
                    <button type="submit" class="bg-[#1b1b18] text-white px-6 py-2 rounded-md hover:bg-black transition-colors text-sm font-medium">
                        Guardar Cambios
                    </button>
                    
                    
                </div>
            </form>
        </main>

    </div>
</div>