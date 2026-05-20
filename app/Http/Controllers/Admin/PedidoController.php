<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }

        $pedidos = Pedido::with(['usuario', 'detalles.producto'])
            ->orderBy('Fecha', 'desc')
            ->paginate(10);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }

        $pedido = Pedido::with(['usuario', 'detalles.producto'])
            ->findOrFail($id);

        return view('admin.pedidos.show', compact('pedido'));
    }

    public function updateEstado(Request $request, $id)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'estado' => 'required|in:Pendiente,Pagado,Enviado,Cancelado'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->update(['Estado' => $request->estado]);

        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente');
    }

    public function destroy($id)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }

        $pedido = Pedido::findOrFail($id);
        
        // Eliminar detalles primero (por la restricción de clave externa)
        $pedido->detalles()->delete();
        $pedido->delete();

        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }

    public function estadisticas()
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }

        $estadisticas = [
            'total_pedidos' => Pedido::count(),
            'pedidos_pendientes' => Pedido::where('Estado', 'Pendiente')->count(),
            'pedidos_pagados' => Pedido::where('Estado', 'Pagado')->count(),
            'pedidos_enviados' => Pedido::where('Estado', 'Enviado')->count(),
            'pedidos_cancelados' => Pedido::where('Estado', 'Cancelado')->count(),
            'ingresos_totales' => Pedido::where('Estado', '!=', 'Cancelado')->sum('Total'),
            'ingresos_mes' => Pedido::where('Estado', '!=', 'Cancelado')
                ->whereMonth('Fecha', now()->month)
                ->sum('Total'),
        ];

        return view('admin.pedidos.estadisticas', compact('estadisticas'));
    }
}
