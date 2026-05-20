<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Oferta
 * 
 * Productos en oferta/descuento
 * Nota: Estructura simplificada comparada con Hombre y Mujer
 */
class Oferta extends Model
{
    use HasFactory;

    protected $table = 'Ofertas';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'descripcion', 
        'precio',
        'stock',
        'foto',
        'ID_Categoria'
    ];
    
    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'ID_Categoria' => 'integer'
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'ID_Categoria', 'ID_Categoria');
    }

    // Scope para filtros
    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('ID_Categoria', $categoriaId);
    }

    // Obtener productos en stock
    public function scopeEnStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
