<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    // Nombre de la tabla en la base de datos
    protected $table = 'usuarios';
    
    // Clave primaria personalizada
    protected $primaryKey = 'id_usuario';

    // Campos que pueden ser llenados mediante asignación masiva (mass assignment)
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombre',
        'apellido',
        'sede_id',
        'telefono',
        'contra',
        'rol',
        'novedad',
    ];

    // Campos que no se deben mostrar, como la contraseña
    protected $hidden = [
        'contra',
        'remember_token',
    ];

    // Relación con la tabla `sedes`
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }

    // Mutador para encriptar la contraseña automáticamente
    public function setContraAttribute($value)
    {
        $this->attributes['contra'] = Hash::make($value);
    }
}
