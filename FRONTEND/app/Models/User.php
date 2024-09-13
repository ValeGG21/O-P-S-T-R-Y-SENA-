<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    
    protected $primaryKey = 'id_usuario';

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

    protected $hidden = [
        'contra',
        'remember_token',
    ];

    public $timeStamps = true;

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }

    public function setContraAttribute($value)
    {
        $this->attributes['contra'] = Hash::make($value);
    }
}
