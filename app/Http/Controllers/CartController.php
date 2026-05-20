<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseConfirmation;

class CartController extends Controller
{
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
        $id = $request->input('product_id');
        $name = $request->input('product_name');
        $price = (float) $request->input('product_price');
        $image = $request->input('product_image');
        $qty = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        // Si el producto ya existe en el carrito, incrementar cantidad
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            // Nuevo producto
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'image' => $image,
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
        $quantity = $request->input('quantity');

        if ($quantity <= 0) {
            return $this->remove($request);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
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

        // Crear datos del pedido
        $order = [
            'id' => 'ORD-' . date('YmdHis') . '-' . $user->ID_USUario,
            'subtotal' => $total,
            'tax' => $tax,
            'total' => $grandTotal,
            'shipping' => 'Gratis',
            'address' => $request->input('address', 'Tu dirección registrada'),
            'payment_method' => $request->input('payment_method', 'Tarjeta')
        ];

        // Enviar email de confirmación
        try {
            Mail::to($user->getEmailAttribute())->send(new PurchaseConfirmation($user, $order, $cart));
        } catch (\Exception $e) {
            \Log::error('Error enviando email de confirmación: ' . $e->getMessage());
        }

        // Vaciar el carrito
        session()->forget('cart');

        // Redirigir a página de éxito
        return redirect('/checkout/success')->with([
            'order' => $order,
            'message' => '¡Pedido procesado exitosamente! Revisa tu email para los detalles.'
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
}
