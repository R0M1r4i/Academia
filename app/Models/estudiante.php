<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class estudiante extends Authenticatable

{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estudiante';
    protected $fillable =['dni_estudiante','nombre','apellidos','n_celular','direccion',
        'colegio','sede','celular_apoderado','estado_de_pago','pago','carrera_id_carrera',
        'area_academica_id_area','ciclo_id_ciclo', 'referencia','conducta','observacion','especialidad', 'foto'];

    protected  $primaryKey = 'dni_estudiante';

    //belong to

    public function carrera()
    {
        return $this -> belongsTo(carrera::class,'carrera_id_carrera');
    }

    public function area_academica()
    {
        return $this ->belongsTo(area_academica::class,'area_academica_id_area');
    }

    public function  ciclo()
    {
        return $this -> belongsTo(ciclo::class);
    }

    public function horario()
    {
        return $this->belongsTo(horario::class);
    }


    //hasMany

    public function asistencia()
    {
        return $this ->hasMany(asistencia::class, 'estudiante_dni');
    }

    public function  nota_fast()
    {
        return $this -> hasMany(nota_fast::class);
    }

    public function nota_eta()
    {
        return $this -> hasMany(nota_eta::class);
    }

    //belongToMany

    public function docente()
    {
        return $this->belongsToMany(docente::class, 'estudiante_docente', 'estudiante_dni', 'docente_dni');
    }

    public function curso()
    {
        return $this->belongsToMany(curso::class, 'estudiante_curso', 'estudiante_dni','curso_dni');
    }



}


