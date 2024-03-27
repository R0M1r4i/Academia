<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class docente extends Model
{
    use HasFactory;
    protected $table = 'docente';

    public $timestamps = false;

    protected $fillable = ['dni_docente', 'nombre_docente', 'apellido_docente', 'celular','rendimiento','horario_inicio', 'horario_final'];

    protected $primaryKey = 'dni_docente';

    public function curso()
    {
        return $this -> hasMany(curso::class);
    }

    public function estudiante()
    {
        return $this->belongsToMany(estudiante::class, 'estudiante_docente', 'docente_dni', 'estudiante_dni');
    }

    public function asistencia()
    {
        return $this ->hasMany(asistencia::class,'docente_dni');
    }

}
