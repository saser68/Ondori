<?php

namespace App\Http\Controllers;

use App\Models\Hombre;
use App\Models\Mujer;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;
use App\Mail\PurchaseConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    private const PRODUCT_MODELS = [
        'Hombre' => Hombre::class,
        'Mujer' => Mujer::class,
        'Ofertas' => Oferta::class,
    ];

    /**
     * Mostrar el carrito de compras
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('shop.carrito', compact('cart', 'total'));
    }

    /**
     * Añadir producto al carrito
     * TODO: Mejorar validación de cantidad y precios
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|min:1',
            'product_table' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $id = (int) $request->input('product_id');
        $table = $this->normalizeProductTable($request->input('product_table'));
        $qty = (int) $request->input('quantity', 1);
        $model = self::PRODUCT_MODELS[$table];
        $product = $model::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $cart = session()->get('cart', []);
        $cartKey = $this->cartKey($table, $id);
        $currentQty = $cart[$cartKey]['quantity'] ?? 0;

        if (($currentQty + $qty) > $product->stock) {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible');
        }

        // Si el producto ya existe en el carrito, incrementar cantidad
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $qty;
        } else {
            // Nuevo producto
            $cart[$cartKey] = [
                'id' => $id,
                'table' => $table,
                'name' => $product->nombre,
                'price' => (float) $product->precio,
                'image' => $product->foto,
                'quantity' => $qty
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }

    /**
     * Actualizar cantidad de producto
     */
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        if ($quantity <= 0) {
            return $this->remove($request);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $item = $cart[$productId];
            $table = $this->normalizeProductTable($item['table'] ?? null);
            $model = self::PRODUCT_MODELS[$table];
            $realProductId = (int) ($item['id'] ?? $productId);
            $product = $model::find($realProductId);

            if (!$product) {
                return redirect()->back()->with('error', 'Producto no encontrado');
            }

            if ($quantity > $product->stock) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible');
            }

            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrito actualizado');
    }

    /**
     * Eliminar producto del carrito
     */
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Vaciar carrito
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Carrito vaciado');
    }

    /**
     * Calcular total del carrito
     * Nota: No incluye impuestos ni envío
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $subtotal = (float) $item['price'] * (int) $item['quantity'];
            $total += $subtotal;
        }
        return round($total, 2);
    }

    /**
     * Procesar el checkout/compra
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect('/carrito')->with('error', 'Tu carrito está vacío');
        }

        $user = auth()->user();
        $total = $this->calculateTotal($cart);
        $tax = $total * 0.21;
        $grandTotal = $total + $tax;

        try {
            $order = DB::transaction(function () use ($cart, $user, $total, $tax, $grandTotal, $request) {
                $pedido = Pedido::create([
                    'ID_Usuario' => $user->ID_USUario,
                    'Total' => $grandTotal,
                    'Estado' => 'Pagado',
                ]);

                foreach ($cart as $cartKey => $item) {
                    $table = $this->normalizeProductTable($item['table'] ?? null);
                    $model = self::PRODUCT_MODELS[$table];
                    $productId = (int) ($item['id'] ?? $cartKey);
                    $quantity = (int) $item['quantity'];

                    $updated = $model::where('id_producto', $productId)
                        ->where('stock', '>=', $quantity)
                        ->decrement('stock', $quantity);

                    if ($updated === 0) {
                        throw new \RuntimeException('No hay suficiente stock para ' . ($item['name'] ?? 'el producto seleccionado'));
                    }

                    PedidoDetalle::create([
                        'ID_Pedido' => $pedido->ID_Pedido,
                        'ID_Producto' => $productId,
                        'Tabla_Origen' => $table,
                        'Cantidad' => $quantity,
                        'Precio_Unitario' => (float) $item['price'],
                    ]);
                }

                return [
                    'id' => 'ORD-' . $pedido->ID_Pedido,
                    'subtotal' => $total,
                    'tax' => $tax,
                    'total' => $grandTotal,
                    'shipping' => 'Gratis',
                    'address' => $request->input('address', 'Tu dirección registrada'),
                    'payment_method' => $request->input('payment_method', 'Tarjeta')
                ];
            });
        } catch (\RuntimeException $e) {
            return redirect('/carrito')->with('error', $e->getMessage());
        }

        // Enviar email de confirmación
        try {
            Mail::to($user->Email)->send(new PurchaseConfirmation($user, $order, $cart));
        } catch (\Throwable $e) {
            Log::error('Error enviando email de confirmación: ' . $e->getMessage());
        }

        // Vaciar el carrito
        session()->forget('cart');

        // Redirigir a página de éxito
        return redirect('/checkout/success')->with([
            'order' => $order
        ]);
    }

    /**
     * Página de éxito del checkout
     */
    public function checkoutSuccess()
    {
        if (!session('order')) {
            return redirect('/carrito');
        }

        return view('checkout.success', ['order' => session('order')]);
    }

    /**
     * Obtener número de items en el carrito (para el header)
     */
    public static function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    private function normalizeProductTable(?string $table): string
    {
        return match (strtolower((string) $table)) {
            'mujer', 'mujeres' => 'Mujer',
            'oferta', 'ofertas' => 'Ofertas',
            default => 'Hombre',
        };
    }

    private function cartKey(string $table, int $id): string
    {
        return $table . ':' . $id;
    }
}
