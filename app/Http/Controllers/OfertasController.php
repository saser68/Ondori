<?php

namespace App\Http\Controllers;

use App\Models\Hombre;
use Illuminate\Http\Request;

class OfertasController extends Controller
{
    /**
     * Muestra 3 productos aleatorios de la tabla Hombre como ofertas.
     */
    public function index()
    {
        $productos = Hombre::inRandomOrder()->limit(3)->get();

        return view('shop.ofertas', compact('productos'));
    }
}
