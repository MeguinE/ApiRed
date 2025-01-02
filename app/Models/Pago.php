<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;


    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_socio',
        'fecha_pago',
        'monto',
        'adeudo',
        'descripcion',
    ];

    public $timestamps = false;

    //Relacion con el modelo Socio
    public function socio()
    {
        return $this->belongsTo(User::class, 'id_socio', 'id,socio');
    }
}
