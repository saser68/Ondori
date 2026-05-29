<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'Usuarios';
    protected $primaryKey = 'ID_USUario';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Email',
        'Telefono',
        'Password'
    ];

    protected $hidden = [
        'Password'
    ];

    // Accessor para name (mapear Nombre + Apellido)
    public function getNameAttribute()
    {
        return $this->Nombre . ' ' . $this->Apellido;
    }

    // Mapear campos de BD a propiedades de Laravel
    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }

    // Mutador para hashear el password automáticamente
    public function setPasswordAttribute($value)
    {
        // Si el password ya está hasheado, no lo hasheamos de nuevo
        if (Hash::needsRehash($value)) {
            $this->attributes['Password'] = Hash::make($value);
        } else {
            $this->attributes['Password'] = $value;
        }
    }

    // Relación con direcciones
    public function direcciones()
    {
        return $this->hasMany(Direccion::class, 'ID_USUario', 'ID_USUario');
    }

    // Relación con pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'ID_Usuario', 'ID_USUario');
    }

    // Nombre completo para mostrar
    public function getNombreCompletoAttribute()
    {
        return $this->Nombre . ' ' . $this->Apellido;
    }
}
