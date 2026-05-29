<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;

    protected $table = 'Pedido_Detalles';
    protected $primaryKey = 'ID_Detalle';
    public $timestamps = false;

    protected $fillable = [
        'ID_Pedido',
        'ID_Producto',
        'Tabla_Origen',
        'Cantidad',
        'Precio_Unitario'
    ];

    protected $casts = [
        'Precio_Unitario' => 'decimal:2'
    ];

    // Relación con el pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'ID_Pedido', 'ID_Pedido');
    }

    // Obtener el producto dinámicamente según la tabla de origen
    // Nota: Esta relación no funciona con eager loading directo debido a que cambia según Tabla_Origen
    // Para eager loading, usar las relaciones específicas: productoHombre, productoMujer, productoOferta
    public function producto()
    {
        switch ($this->Tabla_Origen) {
            case 'Hombre':
                return $this->belongsTo(Hombre::class, 'ID_Producto', 'id_producto');
            case 'Mujer':
                return $this->belongsTo(Mujer::class, 'ID_Producto', 'id_producto');
            case 'Ofertas':
                return $this->belongsTo(Oferta::class, 'ID_Producto', 'id_producto');
            default:
                return null;
        }
    }

    // Relaciones específicas para eager loading
    public function productoHombre()
    {
        return $this->belongsTo(Hombre::class, 'ID_Producto', 'id_producto');
    }

    public function productoMujer()
    {
        return $this->belongsTo(Mujer::class, 'ID_Producto', 'id_producto');
    }

    public function productoOferta()
    {
        return $this->belongsTo(Oferta::class, 'ID_Producto', 'id_producto');
    }

    // Tablas de origen posibles
    public static function getTablasOrigen()
    {
        return ['Hombre', 'Mujer', 'Ofertas'];
    }
}
