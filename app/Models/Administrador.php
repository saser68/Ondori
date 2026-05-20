<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo Administrador
 * 
 * Usuarios con acceso al panel de administración
 * La BD tiene estructura custom, hay que manejar esto manualmente
 */
class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'Administradores';
    protected $primaryKey = 'ID_Admin';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Email',
        'Password'
    ];

    protected $hidden = [
        'Password'
    ];

    // Métodos requeridos por Authenticatable
    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }

    // Accesor para el email
    public function getEmailAttribute()
    {
        return $this->attributes['Email'] ?? null;
    }

    // Mutador para el email
    public function setEmailAttribute($value)
    {
        $this->attributes['Email'] = $value;
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

    // Nombre para mostrar
    public function getNameAttribute()
    {
        return $this->Nombre;
    }
}
