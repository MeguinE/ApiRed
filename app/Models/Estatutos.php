<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatutos extends Model
{
    use HasFactory;

    
    protected $table = 'estatutos';
    protected $primaryKey = 'id_estatuto';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'titulo',
        'contenido',
        'fecha_creacion',
    ];

    public $timestamps = false;
    
}
