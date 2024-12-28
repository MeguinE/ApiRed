<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';
    protected $primaryKey = 'id_asistencia';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_evento',
        'id_socio',
        'fecha_asistencia',
    ];

    public $timestamps = false;

    //Relacion con las demas tablas
    public function socio()
    {
        return $this->belongsTo(User::class, 'id_socio', 'id_socio');
    }

    public function evento()
    {
        return $this->belongsTo(Eventos::class, 'id_evento', 'id_evento');
    }
}
