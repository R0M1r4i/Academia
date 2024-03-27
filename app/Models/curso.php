<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    use HasFactory;
    protected $table = 'curso';

    public $timestamps = false;
    protected $fillable = ['id_curso','nombre_curso','docente_dni_docente','ciclo_id_ciclo'];

    protected $primaryKey = 'id_curso';

    public function ciclo()
    {
        return $this ->belongsTo(ciclo::class);
    }

    public function docente()
    {
        return $this -> belongsTo(docente::class);
    }

    public function area_academica()
    {
        return $this->belongsToMany(area_academica::class, 'area_academica_curso', 'curso_id', 'area_id');
    }

    public function estudiante()
    {
        return $this->belongsToMany(estudiante::class, 'estudiante_curso', 'curso_id','estudiante_dni');
    }

}
