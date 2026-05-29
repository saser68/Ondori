<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertasController extends Controller
{
    /**
     * Muestra 3 productos aleatorios de la tabla Oferta.
     */
    public function index()
    {
        $productos = Oferta::inRandomOrder()->limit(3)->get();

        return view('shop.ofertas', compact('productos'));
    }
}
