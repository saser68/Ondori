<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hombre;
use App\Models\Mujer;
use App\Models\Oferta;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Dashboard del admin
     * 
     * TODO: Agregar check más robusto de permisos (usar policies)
     */
    public function dashboard()
    {
        // Solo el admin puede ver el dashboard
        if (!auth()->check()) {
            abort(403, 'No autenticado');
        }

        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }
        
        // Datos para la vista
        $usuarios = Usuario::all();
        
        // Stats rápidas
        $stats = [
            'total_productos_hombre' => Hombre::count(),
            'total_productos_mujer' => Mujer::count(),
            'total_productos_ofertas' => Oferta::count(),
            'total_usuarios' => Usuario::count(),
            'total_pedidos' => Pedido::count(),
            'pedidos_pendientes' => Pedido::where('Estado', 'Pendiente')->count()
        ];
        
        $categorias = Categoria::all();
        
        // Últimos 5 pedidos
        $pedidos_recientes = Pedido::with('usuario')
            ->orderBy('Fecha', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact('usuarios', 'stats', 'categorias', 'pedidos_recientes'));
    }
    
    public function storeProduct(Request $request)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }
        
        $request->validate([
            'category' => 'required|in:hombre,mujer,ofertas',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'required|string',
            'tipoRopa' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'talla' => 'nullable|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'foto.required' => 'Selecciona una foto del producto.',
            'foto.image' => 'La foto debe ser una imagen válida.',
            'foto.mimes' => 'La foto debe estar en formato JPEG, PNG, JPG o GIF.',
            'foto.max' => 'La foto no puede pesar más de 2 MB.',
        ]);
        
        // Subir imagen
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Determinar carpeta según categoría
            $folder = 'img/' . $request->category;
            if (!File::exists(public_path($folder))) {
                File::makeDirectory(public_path($folder), 0755, true);
            }

            $image->move(public_path($folder), $imageName);
            $imagePath = $folder . '/' . $imageName;
        }
        
        // Obtener ID de categoría según el tipo de producto
        $categoriaId = match($request->category) {
            'hombre' => 1,
            'mujer' => 2,
            'ofertas' => 3,
            default => 1
        };
        
        // Preparar datos
        $productData = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock ?? 0,
            'foto' => $imagePath,
            'ID_Categoria' => $categoriaId
        ];
        
        // Añadir campos específicos según categoría
        if ($request->category !== 'ofertas') {
            $productData['tipoRopa'] = $request->tipoRopa;
            $productData['color'] = $request->color;
            $productData['talla'] = $request->talla ?? 'S, M, L, XL';
        }
        
        // Guardar en tabla correspondiente
        switch ($request->category) {
            case 'hombre':
                Hombre::create($productData);
                break;
            case 'mujer':
                Mujer::create($productData);
                break;
            case 'ofertas':
                Oferta::create($productData);
                break;
        }
        
        return redirect()->route('admin.dashboard')->with('success', '¡Producto añadido correctamente!');
    }
    
    public function storeUser(Request $request)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:Usuarios,Email',
            'telefono' => 'nullable|string|max:20',
            'password' => 'required|string|min:6'
        ]);
        
        // Crear nuevo usuario usando el modelo (el password se hashea automáticamente)
        Usuario::create([
            'Nombre' => $request->nombre,
            'Apellido' => $request->apellido,
            'Email' => $request->email,
            'Telefono' => $request->telefono,
            'Password' => $request->password // El modelo lo hashea automáticamente
        ]);
        
        return redirect()->route('admin.dashboard')->with('success', '¡Usuario añadido correctamente!');
    }
    
    public function editUser($id)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }
        
        $usuario = Usuario::findOrFail($id);
        
        return view('admin.users.edit', compact('usuario'));
    }
    
    public function updateUser(Request $request, $id)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:Usuarios,Email,' . $id . ',ID_USUario',
            'telefono' => 'nullable|string|max:20'
        ]);
        
        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'Nombre' => $request->nombre,
            'Apellido' => $request->apellido,
            'Email' => $request->email,
            'Telefono' => $request->telefono
        ]);
        
        return redirect()->route('admin.dashboard')->with('success', '¡Usuario actualizado correctamente!');
    }
    
    public function deleteUser($id)
    {
        if (auth()->user()->email !== 'admin@ondori.com') {
            abort(403, 'No autorizado');
        }
        
        // No permitir eliminar al admin
        $usuario = Usuario::findOrFail($id);
        if ($usuario->Email === 'admin@ondori.com') {
            return redirect()->route('admin.dashboard')->with('error', 'No puedes eliminar al administrador');
        }
        
        $usuario->delete();
        
        return redirect()->route('admin.dashboard')->with('success', '¡Usuario eliminado correctamente!');
    }
}
