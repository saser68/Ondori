<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Mujer - Productos para mujeres
 * 
 * Similar a Hombre, mantiene los nombres de BD heredados
 */
class Mujer extends Model
{
    use HasFactory;

    protected $table = 'Mujer';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'descripcion', 
        'tipoRopa',
        'color',
        'talla',
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

    // Scopes para queries comunes
    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('ID_Categoria', $categoriaId);
    }

    public function scopeEnStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
