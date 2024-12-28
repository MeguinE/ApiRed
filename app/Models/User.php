<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'socios';
    protected $primaryKey = 'id_socio';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'domicilio',
        'correo',
        'telefono',
        'rfc',
        'rnt',
        'empresa',
        'lugar_desarrollo',
        'estado',
        'usuario',
        'contrasena',
        'rol',
        'fecha_registro',
    ];

    public function pagos(){
        return $this ->hasMany(Pago::class, 'id_socio');
    }

    public function asistencias(){
        return $this->hasMany(Asistencia::class, 'id_socio');
    }
   
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
