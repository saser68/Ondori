<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'Pedidos';
    protected $primaryKey = 'ID_Pedido';
    public $timestamps = false;

    protected $fillable = [
        'ID_Usuario',
        'Fecha',
        'Total',
        'Estado'
    ];

    protected $casts = [
        'Fecha' => 'datetime',
        'Total' => 'decimal:2'
    ];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID_USUario');
    }

    // Relación con los detalles del pedido
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'ID_Pedido', 'ID_Pedido');
    }

    // Estados posibles
    public static function getEstados()
    {
        return ['Pendiente', 'Pagado', 'Enviado', 'Cancelado'];
    }
}
