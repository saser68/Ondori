<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'Direccion';
    protected $primaryKey = 'ID_direccion';
    public $timestamps = false;

    protected $fillable = [
        'ID_USUario',
        'Calle',
        'Numero',
        'Ciudad',
        'Pais'
    ];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_USUario', 'ID_USUario');
    }

    // Dirección completa para mostrar
    public function getDireccionCompletaAttribute()
    {
        return "{$this->Calle} {$this->Numero}, {$this->Ciudad}, {$this->Pais}";
    }
}
