<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ondori')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Estilos base de tarjetas de producto */
        .product-card { 
            margin-bottom: 20px; 
            display: flex;
            flex-direction: column;
        }

        .product-image-container { 
            position: relative; 
            border-radius: 8px; 
            overflow: hidden; 
            background: #f5f5f5; 
            min-height: 220px;
        }

        .product-image { 
            width: 100%; 
            height: auto; 
            max-height: 420px;
            object-fit: cover; 
            transition: transform 0.3s ease-in-out; 
            display: block;
        }

        .product-card:hover .product-image { 
            transform: scale(1.05); 
        }

        .btn-primary { 
            background: #333; 
            color: white; 
            padding: 10px 20px; 
            border-radius: 5px; 
            font-weight: bold; 
            text-decoration: none; 
            display: inline-block; 
            transition: background 0.3s;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #111827;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            transition: background 0.3s;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* Botones principales */
        .btn-primary { 
            background: #333; 
            color: white; 
            padding: 10px 20px; 
            border-radius: 5px; 
            font-weight: bold; 
            text-decoration: none; 
            display: inline-block; 
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #555;
        }

        /* Carrito - contador badge */
        .cart-count { 
            position: absolute; 
            top: -8px; 
            right: -8px; 
            background: black; 
            color: white; 
            width: 20px; 
            height: 20px; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 11px; 
        }

        /* TODO: Mejorar esto luego */
        input[type="text"], 
        input[type="email"], 
        input[type="tel"], 
        input[type="password"] {
            background-color: white !important;
            background: white !important;
        }
    </style>
    
    @stack('styles')
</head>

<body class="bg-white text-gray-900 min-h-screen">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
