<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_registro',
        'descripcion_registro',
        'estado_registro',
    ];
    protected $table = 'equipo';
    protected $primaryKey = 'equipo_id';
}
