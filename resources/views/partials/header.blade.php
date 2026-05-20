<!-- Header principal con navegación sticky (fijo al hacer scroll) -->
<header class="w-full bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center h-auto md:h-16">
            
            <!-- Logo de la marca Ondori -->
            <div class="flex-shrink-0">
                <a href="/" class="font-bold text-2xl tracking-tight text-gray-900 hover:text-gray-700 transition">
                    Ondori
                </a>
            </div>

            <!-- Menú de navegación principal -->
            <nav class="nav-desktop flex flex-wrap items-center justify-center gap-4 md:justify-start">
                <a href="#" class="text-gray-700 hover:text-gray-900 transition font-medium">Nueva Colección</a>
                <a href="/mujeres" class="text-gray-700 hover:text-gray-900 transition font-medium">Mujer</a>
                <a href="/hombres" class="text-gray-700 hover:text-gray-900 transition font-medium {{ request()->is('hombres*') ? 'text-gray-900 font-bold border-b-2 border-black' : '' }}">Hombre</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 transition font-medium">Ofertas</a>
                @auth
                    @if(auth()->user()->email === 'admin@ondori.com')
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-700 transition font-medium">
                            Admin
                        </a>
                    @endif
                @endauth
            </nav>

            <!-- Iconos de acciones: buscador, carrito y usuario -->
            <div class="flex flex-col sm:flex-row sm:flex-wrap items-center gap-3 w-full md:w-auto justify-center md:justify-end">
                <!-- Buscador integrado -->
                <form action="{{ route('search') }}" method="GET" class="flex items-center bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden w-full md:w-auto">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar productos..." 
                        class="flex-1 min-w-0 px-3 py-2 outline-none text-gray-900" />
                    <button type="submit" class="px-3 py-2 text-gray-600 hover:text-gray-900">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <!-- Carrito de compras con contador -->
                <a href="/carrito" class="text-gray-700 hover:text-gray-900 transition relative">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    @php
                        $cartCount = \App\Http\Controllers\CartController::getCartCount();
                    @endphp
                    @if($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
                
                <!-- Sistema de autenticación: muestra dashboard si está logueado, sino login -->
                @auth
                    <div class="flex flex-wrap items-center gap-2 justify-center">
                        <a href="{{ url('/profile') }}" class="text-gray-700 hover:text-gray-900 transition">
                            <i class="fas fa-user text-lg"></i>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-gray-900 transition font-medium">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-wrap items-center gap-2 justify-center">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 transition font-medium">
                            Iniciar sesión
                        </a>
                        <span class="text-gray-400 mx-2">|</span>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 transition font-medium">
                            Registrarse
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
