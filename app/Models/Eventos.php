<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre_evento',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    public $timestamps = false;

    //Relacion con la tabla de asistencia
    public function asistencias(){
        return $this->hasMany(Asistencia::class, 'id_evento','id_evento');
    }
}
