<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class usuario extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'usuario';

    protected  $fillable = ['id_usuario', 'nombre','apellido', 'usuario', 'contraseña','rol'];
    protected  $primaryKey ='id_usuario';

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}

