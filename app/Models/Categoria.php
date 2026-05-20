<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Categoría
 * Vincula Hombre, Mujer y Ofertas
 */
class Categoria extends Model
{
    use HasFactory;

    protected $table = 'Categorias';
    protected $primaryKey = 'ID_Categoria';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Categoria'
    ];

    // Relaciones con productos de cada categoría
    public function productosHombre()
    {
        return $this->hasMany(Hombre::class, 'ID_Categoria', 'ID_Categoria');
    }

    public function productosMujer()
    {
        return $this->hasMany(Mujer::class, 'ID_Categoria', 'ID_Categoria');
    }

    public function productosOfertas()
    {
        return $this->hasMany(Oferta::class, 'ID_Categoria', 'ID_Categoria');
    }
}
