<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo de Usuario/Cliente
 * 
 * Nota: La tabla se llama 'Usuarios' pero el modelo se llama 'User'
 * porque es más estándar en Laravel
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // La tabla no sigue la convención plural de Laravel
    protected $table = 'Usuarios';

    protected $primaryKey = 'ID_USUario';

    // Sin timestamps por ahora (TODO: agregar created_at/updated_at en BD)
    public $timestamps = false;


    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'Nombre',
        'Apellido',
        'Email',
        'Telefono',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the email address for the user.
     *
     * @return string
     */
    public function getEmailAttribute()
    {
        return $this->attributes['Email'];
    }

    /**
     * Set the email address for the user.
     *
     * @param string $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['Email'] = $value;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Set the password for the user.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value;
    }

    /**
     * Get the name for the user.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->attributes['Nombre'] . ' ' . $this->attributes['Apellido'];
    }

    /**
     * Get the email for authentication.
     *
     * @return string
     */
    public function getEmailForAuth()
    {
        return $this->Email;
    }
}
